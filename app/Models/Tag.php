<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/16
 * Time: 下午4:30
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public static function selectOptions(){
        $all                                    =   static::all();
        $data                                   =   [];
        foreach ($all as  $item){

            $array[$item->id]                   =   $item->name;
            $data                               =   array_merge_recursive($data,$array);
        }
        return array_unique($data);
    }
}