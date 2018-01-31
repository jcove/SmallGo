<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2018/1/29
 * Time: 17:03
 */

namespace App\Models;



use Illuminate\Database\Eloquent\Model;

class ScheduleLog extends Model
{
    public static function getByMd5($md5){
        return static :: where(['md5'=>$md5])->first();
    }
}