<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/25
 * Time: 下午1:48
 */

namespace App\Api\Controllers;



use App\Models\Ad;

class AdController extends BaseController
{
    public function banner(){
        return $this->response->array(Ad::getList()->toArray());
    }

    public function category(){
        $request                            =   request();
        return Ad::getCategoryCover($request->id);
    }
}