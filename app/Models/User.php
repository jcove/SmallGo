<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/27
 * Time: 16:11
 */

namespace App\Models;


use App\Common\Utils;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public static function getByWechatId($wechatId){
        return static ::where('wechat_id',$wechatId)->first();
    }

    public function setNickAttribute($nick){
        return Utils::removeEmoji($nick);
    }
}