<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/12
 * Time: 上午10:34
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GoodsShare;
use App\RestResponse;

class CategoryController extends Controller
{
    public function info($id){
        $categoryModel                      =   new Category();
        $categoryChildren                   =   $categoryModel->getChildren($id);
        $categoryInfo                       =   Category::where(['id'=>$id])->first();

        $data['category']                   =   $categoryInfo;
        $data['children']                   =   $categoryChildren;

        return RestResponse::data($data);
    }

    public function goods($id,$sort='id',$desc='desc'){
        $category                           =   Category::info($id);
        if($category){
            $goods                              =   GoodsShare::where(['status'=>1,'category_id'=>$id])->orderBy($sort,$desc)->paginate(16);
            $data['list']                       =   GoodsShare::setCouponPrice($goods);
            $data['title']                      =   $category->name;
            $data['desc']                       =   $desc=='desc'? 'asc' : 'desc';
            $data['category_id']                =   $id;
            $data['sort']                       =   $sort;
            return smallgo_view('category.goods',$data);
        }
    }

    public function tree(){
        $lists                              =   Category::getAllCategory(0);
        return RestResponse::data($lists);

    }
    public function options(){
        $data                               =   Category::allSelectOptions();
        $list                               =   [];
        foreach ($data as $k =>$v){
            $list[]                         =   ['id'=>$k,'name'=>$v];
        }
        return $list;
    }

}