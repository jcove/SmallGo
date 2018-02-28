<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/9/27
 * Time: 上午10:56
 */

namespace App\Http\Controllers;


use App\Common\TaoBao;
use App\Models\Ad;
use App\Models\Category;
use App\Models\GoodsGallery;
use App\Models\GoodsShare;
use App\Models\History;
use App\Models\RecommendGoods;
use App\Models\TagGoods;
use Carbon\Carbon;
use TbkItemInfoGetRequest;
use TopClient;

class GoodsController extends Controller
{
    /**
     * 站内商品详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function detail($id){
        $goods                                  =   GoodsShare::where(['id'=>$id,'status'=>1])->first();
        $data                                   =   [];
        if($goods){

            $data['title']                          =   $goods->title ? $goods->title : $goods->name;
            $data['code']                           =   base64_encode($goods->click_url);
            $taobao                                 =   new TaoBao();
            $cycle                              =   config('site.goods_update_cycle',0);
            if($cycle > 0){
                $lastUpdateTime                 =   new Carbon($goods->updated_at);
                if($lastUpdateTime->addDay($cycle)<Carbon::now()){
                    $item                       =   $taobao->item($goods->original_id);
                    if($item){
                        $goods->title           =   $item->title;
                        $goods->volume          =   $item->volume;
                        $goods->pictures        =   $item->pictures;
                        $goods->cover           =   $item->cover;
                        $goods->price           =   $item->price;
                        $goods->save();
                    }else{
                        $goods->status          =   -1;
                        $goods->save();
                    }
                }
            }
            $data['goods']                          =   $goods;
        }

        return smallgo_view('goods.item',$data);
    }

    /**
     * 淘宝商品详情
     * @param $num_iid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function info($num_iid){
        $click_url                          =   request()->click_url;
        $coupon_start_time                  =   request()->coupon_start_time;
        $coupon_end_time                    =   request()->coupon_end_time;
        $coupon_amount                      =   request()->coupon_amount;
        $taobao                             =   new TaoBao();
        $goods                              =   $taobao->item($num_iid);
        $goods->coupon_start_time           =   $coupon_start_time;
        $goods->coupon_end_time             =   $coupon_end_time;
        $goods->coupon_amount               =   $coupon_amount;
        $data['title']                      =   $goods->title;
        $data['goods']                      =   $goods;
        $data['code']                       =   base64_encode($click_url);
        return smallgo_view('goods.item',$data);
    }

    public function go($num_iid){
        return smallgo_view('goods.go',['id'=>$num_iid]);
    }

}