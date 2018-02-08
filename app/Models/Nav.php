<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2018/1/13
 * Time: 11:46
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    public static function allNav($status = 1){
        $client                             =   is_mobile() ? 'mobile' : 'pc';
        return static ::where(['status'=>$status,'client'=>$client])->get();
    }
}