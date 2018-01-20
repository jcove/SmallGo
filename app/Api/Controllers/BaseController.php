<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/25
 * Time: 下午2:32
 */

namespace App\Api\Controllers;


use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use Helpers;

    public function paginate(){

    }
}