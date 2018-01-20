<?php
/**
 * Created by PhpStorm.
 * User: rw
 * Date: 2017/11/6
 * Time: 16:18
 */

namespace App\Api\Controllers;


use App\Models\Category;
use App\Models\GoodsShare;

class RecommendController extends BaseController
{
    public function index(){
        $categories                     =   Category::getChildren(0);

        foreach ($categories as $k => $v){
            $ids                        =   Category::getAllCategoryId($v->id);
            $categories[$k]->goods      =   GoodsShare::whereIn('category_id',$ids)->get();
        }
        return $this->response->array($categories);
    }
}