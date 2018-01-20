<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/25
 * Time: 下午3:21
 */

namespace App\Api\Controllers;


use App\Models\Category;
use App\Models\RecommendGoods;
use Carbon\Carbon;

class CategoryController extends BaseController
{
    public function children($parentId=0){
        return $this->response->array(Category::getChildren($parentId)->toArray());
    }

    public function goods(){
        $request                                    =          request();
        $size                                       =   $request->size ? $request->size : 10;
        $subId                                      =   $request->sub_id;
        $id                                         =   $request->id;
        $in                                         =   [$subId];
        $categoryModel                              =   new Category();
        if($subId==0){
            $in                                     =   $categoryModel->getAllCategoryId($id);
        }
        $paginate                                   =   RecommendGoods::whereIn('category_id',$in)->paginate($size);
        if($paginate->getCollection()){
            $items                      =   $paginate->getCollection();
            foreach ($items as  $k => $v){
                if(!empty($v->coupon_end_time)){
                    if (Carbon::now()->gt(new Carbon($v->coupon_end_time))){
                        $items[$k]->coupon_status        =   0;
                        $items[$k]->save();
                    }
                }
                if($v->coupon_status > 0){
                    $items[$k]->coupon_price        =   number_format($v->price-$v->coupon_amount,2);
                }else{
                    $items[$k]->coupon_price        =   $v->price;
                }
            }
            $paginate->setCollection($items);
        }
        return $paginate;
    }

    public function lists(){
        return Category::getAllCategory(0);
    }
}