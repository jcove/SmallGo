<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/16
 * Time: 下午4:37
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GoodsTag extends Model
{
    public static function tags($goodsId){
        $tags                                       =   static::where(['goods_id'=>$goodsId])->get();
        if($tags){
            $data                                   =   [];
            foreach ($tags as  $tag){
                $array                              =   [$tag->id];
                $data                               =   array_merge_recursive($data,$array);
            }
            return array_unique($data);
        }
    }
}