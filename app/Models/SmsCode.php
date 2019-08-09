<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2018/6/4
 * Time: 15:29
 */

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SmsCode extends Model
{
    public static function getCode($mobile){
        $now                                        =   new Carbon();
        return                                      static::where(['mobile'=>$mobile,'status'=>0])->where('created_at','>',$now->addMinute(-10))->first();
    }
    public static function useCode($mobile){
        $model =self::getCode($mobile);
        $model->status= 1;
        $model->save();
    }

    public static function verify($mobile,$code){
        $SmsCode                                    =   static::getCode($mobile);
        if($SmsCode){
            return $SmsCode->code ==   $code;
        }else{
            return false;
        }

    }

}