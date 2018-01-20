<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/9/29
 * Time: 下午1:47
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     *
     * @param $md5|String
     */
    public function getByMd5($md5){
       return $this->where(['md5'=>$md5])->first();
    }
}