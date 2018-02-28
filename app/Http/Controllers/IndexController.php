<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/11
 * Time: 上午11:20
 */

namespace App\Http\Controllers;


use App\Models\Ad;
use App\Models\Category;
use App\Models\Channel;
use App\Models\GoodsShare;


class IndexController extends Controller
{
    public function index($sort='id',$desc='desc'){

        $goods                                  =   GoodsShare::where(['status'=>1,'channel_id'=>1])->orderBy($sort,$desc)->paginate(16);

        if($goods){
            $data['list']                       =   GoodsShare::setCouponPrice($goods);
        }

        $data['channels']                       =   Channel::getChildren();



        //幻灯片
        if(is_mobile()){
            $swipers                            =   Ad::getList('mobile_index_swiper');
        }else{
            $swipers                                =   Ad::getList();
        }

        $data['swipers']                        =   $swipers;
        $data['desc']                           =   $desc =='desc' ? 'asc' : 'desc';
        $data['sort']                           =   $sort;

        return smallgo_view('index',$data) ;
    }
}