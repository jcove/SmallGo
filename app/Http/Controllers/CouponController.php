<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/27
 * Time: 下午1:47
 */

namespace App\Http\Controllers;


use TbkDgItemCouponGetRequest;
use TopClient;

class CouponController extends Controller
{
    public function search(){
        $keywords                   =   request()->keywords;
        $pageNO                     =   request()->page_no;
        $c                          =   new TopClient( config('taobao.app_key'),config('taobao.app_secret'));
        $c->format                  =   'json';
        $req                        =   new TbkDgItemCouponGetRequest();
        $req->setAdzoneId("143574150");
        $req->setPlatform("1");
        $req->setQ($keywords);
        $req->setPageNo($pageNO);
        $resp = $c->execute($req);
        $data                       =   [];
        if(empty($resp->code)){
            $data                   =   $resp->results->tbk_coupon;
        }
        return smallgo_view('coupon.search',$data);

    }
}