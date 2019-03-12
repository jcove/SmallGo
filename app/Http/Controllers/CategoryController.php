<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/12
 * Time: 上午10:34
 */

namespace App\Http\Controllers;


use App\Models\Ad;
use App\Models\Category;
use App\Models\GoodsShare;

class CategoryController extends Controller
{
    public function category($id,$title='',$sub_id=0,$sort='id',$desc='desc'){
        $categoryModel                      =   new Category();
        $categoryChildren                   =   $categoryModel->getChildren($id);
        $categoryInfo                       =   Category::where(['id'=>$id])->first();
        $crumb[]                            =   ['title'=>$categoryInfo['name'],'url'=>url('/goods/category',['id'=>$categoryInfo['id']])];

        $in                                 =   [$sub_id];
        if($sub_id==0){
            $in                             =   $categoryModel->getAllCategoryId($id);
        }else{
            $subCategory                    =   Category::where(['id'=>$sub_id])->first();
            $crumb[]                        =   ['title'=>$subCategory->name,'url'=>url('/goods/category',['id'=>$id,'sub_id'=>$sub_id])];
        }
        $goods                              =   GoodsShare::where(['status'=>1])->whereIn('category_id',$in)->orderBy($sort,$desc)->paginate(16);



        $data['list']                       =   GoodsShare::setCouponPrice($goods);
        $data['category_info']              =   $categoryInfo;
        $data['children']                   =   $categoryChildren;
        $data['id']                         =   $id;
        $data['sub_id']                     =   $sub_id;
        $data['sort']                       =   $sort;
        $data['title']                      =   $categoryInfo->name;
        $data['crumb']                      =   $crumb;

        $data['desc']                       =   $desc=='desc'? 'asc' : 'desc';
        return smallgo_view('category.category',$data);
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

    public function lists(){
        $lists                              =   Category::getAllCategory(0);
        $data['list']                       =   $lists;
        $data['title']                      =   '分类';
        return smallgo_view('category.lists',$data);

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