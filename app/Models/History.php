<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2017/11/11
 * Time: 10:22
 */

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    /**
     * @param int $userId
     * @param Carbon $startTime
     * @return mixed
     */
    public static function history($userId=0){
        $list                           =   static::where(['user_id'=>$userId])->paginate(9);
        $in                             =   [];
        foreach ($list as $k=>$v){
            $in[]                       =   $v->goods_id;
        }
        $goods                          =   GoodsShare::whereIn('id',$in)->get();
//        $items                          =   $list->getCollection();
//        foreach ($items as $k=>$v){
//            $items[$k]                  =   $goods[$k];
//        }

        $list->setCollection(GoodsShare::setCouponPrice($goods));
        return $list;
    }
}