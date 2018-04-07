<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2018/1/19
 * Time: 16:02
 */

namespace App\Http\Controllers;


class TestController extends Controller
{
    public function index(){
        $app = app('wechat.official_account');
        $buttons = [
            [
                "type" => "view",
                "name" => "精选",
                "url"  => "http://www.nayiya.com/"
            ],
            "type" => "view",
            "name" => "搜券",
            "url"  => "http://www.nayiya.com/search/coupon"

        ];
        $a=$app->menu->create($buttons);
        dump($a);
    }
}