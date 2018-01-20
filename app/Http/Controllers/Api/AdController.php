<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/25
 * Time: 下午1:48
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Ad;

class AdController extends Controller
{
    public function banner(){
        return response()->json(Ad::getList());
    }
}