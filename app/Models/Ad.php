<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/9
 * Time: 下午1:59
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ad extends Model
{
    public static $Type_Swiper                               =   1;
    public static $Type_Cover                                =   2;
    public static function getList($position='index',$type=1){
        return static::where(['position'=>$position,'type'=>$type])->get()->all();
    }


    public function getCoverUrl(){
        return Storage::disk(config('admin.upload.disk'))->url($this->cover);
    }

    public static function getCategoryCover($categoryId){
        return static::where(['position'=>'category','type'=>static::$Type_Cover,'category_id'=>$categoryId])->first();
    }
    public function getCoverAttribute($cover)
    {
        return get_image_url($cover);
    }
}