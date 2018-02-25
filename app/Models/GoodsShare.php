<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/9/27
 * Time: 上午8:53
 */

namespace App\Models;


use App\Searchable;
use Carbon\Carbon;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use GenPwdIsvParamDto;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

use function Sodium\version_string;
use TbkTpwdCreateRequest;
use TopClient;
use WirelessShareTpwdCreateRequest;

class GoodsShare extends Model
{

    protected $searchable = [
        'columns' => [
            'title' => 8,
        ],
    ];
    public function getByCategoryId($categoryId){
        return $this->where(['category_id'=>$categoryId,'status'=>1])->get();
    }

    public function getNewsByCategoryId($categoryId,$num=4){
        if(is_array($categoryId)){
            return $this->where(['status'=>1])->whereIn('category_id',$categoryId)
                ->orderBy('created_at', 'desc')
                ->take($num)->get();
        }else{
            return $this->where(['category_id'=>$categoryId,'status'=>1])
                ->orderBy('created_at', 'desc')
                ->take($num)->get();
        }

    }

    public static function news($num=16){
        return static::where(['status'=>1])->orderBy('created_at', 'desc')->take($num)->get();
    }

    public function getGalleriesAttribute($value){
        if($value){
            return $value;
        }
        $this->attributes['galleries']  =   GoodsGallery::where(['goods_id'=>$this->id])->get();
        return $this->attributes['galleries'];
    }

    public function setPicturesAttribute($pictures)
    {
        if (is_array($pictures)) {
            $this->attributes['pictures'] = json_encode($pictures);
        }
    }

    public function getPicturesAttribute($pictures)
    {
        if(!empty($pictures)){
            $pictures                           =   json_decode($pictures, true);
            foreach ($pictures as $k=>$v){
                $pictures[$k]                   =   get_image_url($v);
            }
        }
        return $pictures ? $pictures : '';
    }

    public function getCouponAmountAttribute($amount){
        return number_format($amount,0);
    }
    public function toSearchableArray()
    {
        return [
            'title'             =>  $this->title,
            'price'             =>  (double)$this->price,
            'created_at'        =>  Carbon::createFromFormat('Y-m-d h:i:s',$this->created_at)->timestamp,
            'view'              =>  $this->view
        ];
    }

    public static function getByNumIid($numIid){
        return static ::where(['original_id'=>$numIid])->first();
    }

    public static function info($id){
        return static ::where(['id'=>$id])->first();
    }
    public function getCoverAttribute($cover)
    {
        return get_image_url($cover);
    }
    public function getKeywordsAttribute($keywords)
    {
        if(empty($keywords)){
            $keywords                       =   $this->analysis($this->attributes['title']);
            $this->attributes['keywords']   =   $keywords;
            if($this->id){
                $this->save();
            }
        }

        return $keywords;
    }

    public function getDescriptionAttribute($description){
        if(empty($description)){
            return $this->attributes['title'];
        }
        return $description;
    }

    public function analysis($title){

        if(config('app.bosonnlp_token')){
            $client = new Client();
            $str                                    =   $title;
            $res = $client->request('POST', 'http://api.bosonnlp.com/tag/analysis',[
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept'     => 'application/json',
                    'X-Token'      => config('app.bosonnlp_token')
                ],
                'body'=>json_encode([$str])
            ]);
            $body                                   =   (string)$res->getBody();
            $json                                   =   \GuzzleHttp\json_decode($body,true);
            if($json){
                $word                               =   $json[0]['word'];
                $word                               =   implode(',',$word);
                return  $word;
            }
        }
        return '';
    }

    public static function setCouponPrice($items){
        foreach ($items as  $k => $v){
            if(!empty($v->coupon_end_time)){
                if (Carbon::now()->gt(new Carbon($v->coupon_end_time))){
                    $items[$k]->coupon_status        =   0;
                    $items[$k]->save();
                }
            }
            if($v->coupon_status > 0){
                $items[$k]->coupon_price        =   floatval($v->price-$v->coupon_amount);
            }else{
                $items[$k]->coupon_price        =   floatval($v->price);
            }
            $items[$k]->coupon_amount           =   number_format($v->coupon_amount);
        }
        return $items;
    }
    public function getCouponPriceAttribute(){
        if($this->isCoupon()){
            return floatval($this->price-$this->coupon_amount);
        }else{
            return floatval($this->price);
        }
    }
    public static function getCouponGoods(){
        $list                                   =   static ::where(['coupon_status'=>1])->take(4)->get();
        if($list){
            $list                               =   static ::setCouponPrice($list);
        }
        return $list;
    }
    public function getCouponClickUrlAttribute($value){
        if(empty($value)){
            return '';
        }
        if(strpos($value,'http')===false){
            $value                          =   'http:'.$value;
        }
        if(strpos($value,'https')===false){
            return str_replace_first('http','https',$value);
        }
        return $value;
    }
    public function getTpwdAttribute($value){
        if (!empty($value) && Carbon::now()->lt((new Carbon($this->tpwd_create_time))->addDay(30))) {
            return $value;
        }
        $c                                  =   new TopClient;
        $c->appkey                          =   config('taobao.app_key');
        $c->secretKey                       =   config('taobao.app_secret');
        $c->format                          =   'json';
        $req                                =   new TbkTpwdCreateRequest;
        $req->setText($this->title);
        $url                                =   $this->click_url;
        if($this->isCoupon()){
            $url                            =   $this->coupon_click_url;
        }
        if(empty($url)){
            $url                            =   $this->item_url;
        }
        $req->setUrl($url);
        $req->setExt("{}");

        $resp = $c->execute($req);
        if(isset($resp->code)){
            return '';
        }
        $this->attributes['tpwd']           =   $resp->data->model;
        $this->attributes['tpwd_create_time'] = Carbon::now();
        if($this->id >0){
            $this->save();
        }

        return $resp->data->model;
    }
    public function isCoupon(){
        if(!empty($this->coupon_end_time)) {
            if (Carbon::now()->gt(new Carbon($this->coupon_end_time))) {
                $this->coupon_status        =   0;
            }
        }else{
            $this->coupon_status = 0;
        }
        return $this->coupon_status > 0 ? true : false;
    }
    public function updateToEs(){
        $searchable                         =   new Searchable();
        try{
            $data                           =   $searchable->get($this->id);
            $searchable->update($this);
        }catch (Missing404Exception $exception){
            if(!$searchable->exist()){
                $searchable->create();
            }
            $searchable->insert($this);
        }
    }
    public function search($keyword){
        $searchable                         =   new Searchable();
        $in                                 =   $searchable->search($keyword);
        return $this->whereIn('id',$in)->get();

    }
    public function delete()
    {
        return parent::delete(); // TODO: Change the autogenerated stub
    }
    public function deleteFromEs(){
        if($this->status<1){
            $searchable                         =   new Searchable();
            return $searchable->delete($this);
        }
    }

    public function getClickUrlAttribute($value){

        if($this->isCoupon()){
            return $this->coupon_click_url;
        }else{
            if(empty($value)){
                return '';
            }
            if(strpos($value,'http')===false){
                $value                          =   'http:'.$value;
            }
            if(strpos($value,'https')===false){
                return str_replace_first('http','https',$value);
            }
            return $value;
        }
    }
    public function getItemUrlAttribute($value){

        if(empty($value)){
            return '';
        }
        if(strpos($value,'http')===false){
            $value                          =   'http:'.$value;
        }
        if(strpos($value,'https')===false){
            return str_replace_first('http','https',$value);
        }
        return $value;

    }

    public function getPriceAttribute($price){
        return floatval($price);
    }
//    public function save(array $options = [])
//    {
//        $res= parent::save($options); // TODO: Change the autogenerated stub
//        if($this->status <1){
//            $this->deleteFromEs();
//        }else{
//            $this->updateToEs();
//        }
//
//        return $res;
//    }
}