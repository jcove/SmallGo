<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/9/27
 * Time: 上午8:53
 */

namespace App\Models;


use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

use Nicolaslopezj\Searchable\SearchableTrait;
use Overtrue\Pinyin\Pinyin;
use TbkTpwdCreateRequest;
use TopClient;


class GoodsShare extends Model
{
    use SearchableTrait;
    protected $searchable = [
        'columns' => [
            'title' => 8,
            'keywords'=>8,
            'description'=>8,
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
               // $this->save();
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
                  //  $items[$k]->save();
                }
            }else{
                $items[$k]->coupon_status               =   0;
            }
            if($items[$k]->coupon_status > 0){
                $items[$k]->attributes['coupon_price']        =   floatval($v->price-$v->coupon_amount);
            }else{
                $items[$k]->attributes['coupon_price']        =   floatval($v->price);
            }
            $items[$k]->coupon_amount           =   number_format(intval($v->coupon_amount));
        }
        return $items;
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



    public function getClickUrlAttribute($value){

//        if($this->isCoupon()){
//            return $this->coupon_click_url;
//        }else{
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
//        }
    }

    public function setCouponInfoAttribute($value){
        $this->attributes['coupon_info']            =   $value;
        if(empty($this->coupon_amount)){

            if(!empty($value) && $value!='无'){
                preg_match_all('/\d+/',$value , $matches);

                if ($matches) {
                    $couponAmount                               =   0;
                    if(strpos($value,'无条件')){
                        $this->coupon_amount      =   isset($matches[0][0]) ? $matches[0][0] : 0;
                        $this->coupon_start_fee   =   0;
                    }else{
                        $this->coupon_amount      =   isset($matches[0][1]) ? $matches[0][1] : 0;
                        $this->coupon_start_fee   =   isset($matches[0][0]) ? $matches[0][0] : 0;
                    }
                    $this->coupon_price             =   $this->price-$this->coupon_amount;
                }
                $this->coupon_status              =   1;
            }
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

    public function getSeoTitleAttribute($value){
        if(isset($this->attributes['title']) and !empty($this->attributes['title'])){
           $pinyin                              =   new Pinyin();
           $this->attributes['seo_title']       =   $pinyin->permalink($this->attributes['title']);
           return $this->attributes['seo_title'];
        }
        return $value;
    }
}