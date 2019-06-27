<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/20
 * Time: 下午2:51
 */

namespace App\Http\Controllers\Api;


use App\Common\TaoBao;
use App\Http\Controllers\Controller;
use App\Models\GoodsShare;
use App\RestResponse;
use App\Searchable;


class SearchController extends Controller
{
    public function goods($keywords='',$sort='view',$desc='desc'){
        $keywords                           =   $keywords ? $keywords :request()->keywords;
        $list                               =   [];
        if(!empty($keywords)){
        //    $list                           =   GoodsShare::where(['status'=>1])->search($keywords,null,true)->orderBy($sort,'desc')->paginate(9);
            $list                           =   GoodsShare::search($keywords)->where(['status'=>1])->orderBy($sort,$desc)->paginate(10);
            if($list->getCollection()){
                $items                      =   $list->getCollection();
                $list->setCollection(GoodsShare::setCouponPrice($items));
            }
        }

        return RestResponse::data($list);
    }

    public function coupon($keywords=''){
        $keywords                       =   $keywords ? $keywords : request()->keywords;
        $result                         =   [];
        if(!empty($keywords)){
            $taobao                     =   new TaoBao();
            $result                     =   $taobao->searchCoupon($keywords);
        }

        return RestResponse::data($result);
    }

}