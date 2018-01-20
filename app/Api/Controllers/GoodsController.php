<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/25
 * Time: 下午4:48
 */

namespace App\Api\Controllers;


use App\Models\GoodsShare;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;


class GoodsController extends BaseController
{
    public function news(){
        $request                        =   request();
        $num                            =   $request->size ? $request->size : 4;
        $goods                          =   new GoodsShare();
        $paginate                       =   $goods->orderBy('created_at','desc')->paginate($num);

        if($paginate->getCollection()){
            $items                      =   $paginate->getCollection();
            foreach ($items as  $k => $v){
                if(!empty($v->coupon_end_time)){
                    if (Carbon::now()->gt(new Carbon($v->coupon_end_time))){
                        $items[$k]->coupon_status        =   0;
                        $items[$k]->save();
                    }
                }
                if($v->coupon_status > 0){
                    $items[$k]->coupon_price        =   number_format($v->price-$v->coupon_amount,2);
                }else{
                    $items[$k]->coupon_price        =   $v->price;
                }
            }
            $paginate->setCollection($items);
        }
        return $paginate;
    }

    public function detail(){
        $request                        =   request();
        $id                             =   $request->id;
        $goods                          =   GoodsShare::info($id);
        if(!empty($goods->coupon_end_time)){
            if (Carbon::now()->gt(new Carbon($goods->coupon_end_time))){
                $goods->coupon_status        =   0;
                $$goods->save();
            }
        }
        if($goods->coupon_status > 0){
            $goods->coupon_price        =   number_format($goods->price-$goods->coupon_amount,2);
        }else{
            $goods->coupon_price        =   $goods->price;
        }
        return $goods;
    }
}