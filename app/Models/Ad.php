<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/9
 * Time: 下午1:59
 */

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ad extends Model
{

    public static function getList($position='pc_index_swiper'){
        return static::where(['position'=>$position])->where('expire_date','>',Carbon::now()->addDay(-1))->get();
    }


    public function getCoverUrl(){
        return Storage::disk(config('admin.upload.disk'))->url($this->cover);
    }


    public function getCoverAttribute($cover)
    {
        return get_image_url($cover);
    }

    public static function getByPosition($position){
        return static :: where(['position'=>$position])->where('expire_date','>',Carbon::now()->addDay(-1))->first();
    }
}