<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 17/9/26
 * Time: 下午2:54
 */

namespace App\Models;


use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Overtrue\Pinyin\Pinyin;

class Category extends Model
{


    use AdminBuilder,ModelTree;
    public static function getAllCategory($parentId = 0) {
        $allCategories                             =   Cache::get('categories');
        if(empty($allCategories)){
            $categories                             =   static ::getChildren($parentId);
            $allCategories                          =   array();
            if (!empty($categories)) {
                foreach ($categories as $key => $category) {
                    $allCategories[$key]   =   $category;

                    $categoryChild                  =   static ::getChildren($category->id);
                    if (!empty($categoryChild)) {
                        $allCategories[$key]->children = $categoryChild;
                    }
                }
            }
            Cache::put('categories', json_encode($allCategories), 60*12);
            return $allCategories;
        }else{
            return new Collection(is_array($allCategories)? $allCategories : json_decode($allCategories));
        }



    }

    public static function getAllCategoryId($parentId){
        $categories                             =   static ::where('parent_id' , $parentId)->orderBy('order' ,'asc')->get();
        $allCategories[]                        =   $parentId;
        if (!empty($categories)) {
            foreach ($categories as $key => $category) {
                $allCategories[]                =   $category->id;

                $categoryChild                  =   static ::getAllCategory($category->id);
                if (!empty($categoryChild)) {
                    foreach ($categoryChild as $row){
                        $allCategories[]        = $row;
                    }

                }
            }
        }
        return $allCategories;
    }

    public static function getChildren($parentId=0){
        return static::where(['hidden'=>0,'parent_id'=> $parentId])->orderBy('order' ,'asc')->get();
    }

    public static function selectOptions($parentId=0){
        $categories                             =   static::getChildren($parentId);
        $data                                   =   [0=>'无'];
        foreach ($categories as  $category){
            if(!isset($data[$category->id])){
                $data[$category->id]               =   $category->name;
            }
        }
        return array_unique($data);
    }
    public static function allSelectOptions(){
        $categories                                     =   static::getChildren();
        $data                                           =   [0=>'无'];
        foreach ($categories as  $category){
            if(!isset($data[$category->id])){
                $data[$category->id]                    =   $category->name;
            }
            $categoryChild                          =   static::getChildren($category->id);
            foreach($categoryChild as $child){

                if(!isset($data[$child->id])){
                    $data[$child->id]               =   '&nbsp;&nbsp;'.$child->name;

                }
            }
        }

        return $data;
    }

    public static function info($id){
        return static::where(['id'=>$id])->first();
    }

    public static function getName($id){
        $category                               =   static::info($id);
        if($category){
            return $category->name;
        }
        return '';
    }

    public static function getByName($name){
        return static::where(['name'=>$name])->first();
    }
    public static function getByParentIdAndName($parentId,$name){
        return static::where(['parent_id'=>
            $parentId,'name'=>$name])->first();
    }
    public function getSeoTitleAttribute($value){
        if(isset($this->attributes['name']) and !empty($this->attributes['name'])){
            $pinyin                              =   new Pinyin();
            $this->attributes['seo_title']       =   $pinyin->permalink($this->attributes['name']);
            return $this->attributes['seo_title'];
        }
        return $value;
    }
}