<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2017/11/30
 * Time: 18:09
 */

namespace App\Common;


use Carbon\Carbon;

class Time
{
    public static function get_last_time($targetTime)
    {
        $carbon                         =   new Carbon($targetTime);
        $now                            =   Carbon::now();
        $yestoday                       =   Carbon::yesterday();
        $before                         =   $yestoday->subDay(1);
        if($carbon->gt($yestoday) && $carbon->lt($before)){
            return '昨天';
        }else{
            return $carbon->toDateString();
        }
    }
}