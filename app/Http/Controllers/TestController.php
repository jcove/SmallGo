<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2018/1/19
 * Time: 16:02
 */

namespace App\Http\Controllers;


use App\Common\TaoBao;

class TestController extends Controller
{
    public function index(){
        $taobao         =   new TaoBao();
        $list = $taobao->recommend('534326029560');
        dump($list);
        return view('test');
    }
}