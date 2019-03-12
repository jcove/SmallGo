<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/26
 * Time: 19:26
 */

namespace App\Http\Controllers;


use App\Models\Recommend;
use App\Models\RecommendGoods;
use Carbon\Carbon;


class RecommendController extends Controller
{
    public function recommend($id,$sort='id',$desc='desc'){
        $list                                   =   RecommendGoods::where('recommend_id',$id)->orderBy($sort,$desc)->paginate(10);
        $list->setCollection(RecommendGoods::setCouponPrice($list->getCollection()));
        $data['list']                           =   $list;
        $recommendInfo                          =   Recommend::info($id);
        $data['title']                          =   $recommendInfo['name'];
        $data['id']                             =   $id;
        $data['sort']                           =   $sort;
        $data['desc']                           =   $desc=='desc' ? 'asc' : 'desc';
        return smallgo_view('recommend.goods',$data);
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


        return smallgo_view('goods.item',$data);
    }

}