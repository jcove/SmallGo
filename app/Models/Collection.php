<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2017/11/11
 * Time: 10:22
 */

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    /**
     * @param int $userId
     * @param Carbon $startTime
     * @return mixed
     */
    public static function collections($userId=0){
        $list                           =   static::where(['user_id'=>$userId])->paginate(9);
        $in                             =   [];
        foreach ($list as $k=>$v){
            $in[]                       =   $v->goods_id;
        }
        $goods                          =   RecommendGoods::whereIn('id',$in)->get();
        $list->setCollection(RecommendGoods::setCouponPrice($goods));
        return $list;
    }


}