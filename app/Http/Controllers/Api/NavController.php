<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2019/6/26
 * Time: 14:13
 */

namespace App\Http\Controllers\Api;


use App\Models\Nav;
use App\RestResponse;

class NavController
{
    public function list(){
        $client                             =   request()->input('client');
        $navs                               =   Nav::getByClient($client);
        return RestResponse::data($navs);
    }
}