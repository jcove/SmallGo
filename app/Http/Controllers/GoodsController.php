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

    public function detail($id){
        $goods                                  =   GoodsShare::where(['id'=>$id,'status'=>1])->first();
        $data                                   =   [];
        if($goods){
            $data['goods']                          =   $goods;
            $data['title']                          =   $goods->title ? $goods->title : $goods->name;
            $data['code']                           =   base64_encode($goods->click_url);
            $taobao                                 =   new TaoBao();
            $data['recommend_goods_list']           =   $taobao->recommend($goods->original_id);
        }

        return $this->view('goods.item',$data);
    }
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
        return $this->view('goods.item',$data);
    }

    public function go($num_iid){
        return $this->view('goods.go',['id'=>$num_iid]);
    }

}