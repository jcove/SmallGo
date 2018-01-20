<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/26
 * Time: 19:26
 */

namespace App\Http\Controllers;


use App\Models\Channel;
use App\Models\GoodsShare;
use App\Models\Recommend;



class ChannelController extends Controller
{
    public function channel($id,$sort='id',$desc='desc'){
        $list                                   =   GoodsShare::where(['channel_id'=>$id,'status'=>1])->orderBy($sort,$desc)->paginate(10);
        $list->setCollection(GoodsShare::setCouponPrice($list->getCollection()));
        $data['list']                           =   $list;
        $recommendInfo                          =   Channel::info($id);
        $data['title']                          =   $recommendInfo['name'];
        $data['id']                             =   $id;
        $data['sort']                           =   $sort;
        $data['desc']                           =   $desc=='desc' ? 'asc' : 'desc';
        return $this->view('channel.goods',$data);
    }
    public function goods($id){
        $goods                                  =   RecommendGoods::where(['id'=>$id,'status'=>1])->first();

        if($goods->isCoupon()){
            $goods->coupon_price                =   number_format($goods->price-$goods->coupon_amount,2);
            $goods->click_url                   =   $goods->coupon_click_url;
        }else{
            $goods->coupon_price                =   $goods->price;
        }
        $data['goods']                          =   $goods;
        $data['title']                          =   $goods->title ? $goods->title : $goods->name;
        return $this->view('goods.item',$data);
    }
    public function options(){
        $data                                   =    Channel::allSelectOptions();
        $list                                   =   [];
        foreach ($data as $k =>$v){
            $list[]                             =   ['id'=>$k,'name'=>$v];
        }
        return $list;
    }

}