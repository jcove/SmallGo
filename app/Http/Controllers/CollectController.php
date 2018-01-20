<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2017/11/25
 * Time: 13:18
 */

namespace App\Http\Controllers;


use App\Models\Collection;

class CollectController extends Controller
{
    public function collect($id){
        $userId                     =   1;
        $collection                 =   Collection::where(['goods_id'=>$id,'user_id'=>$userId])->first();
        $data['status']             =   1;
        $data['message']            =   'success';
        if(empty($collection)){
            $collection             =   new Collection();
            $collection->user_id    =   $userId;
            $collection->goods_id   =   $id;
            $collection->save();
            $data['message']        =   '收藏成功';
        }else{
            $collection->status     =   $collection->status ==0 ? 1: 0;
            $collection->save();
            if($collection->status==1){
                $data['message']        =   '收藏成功';
            }else{
                $data['message']        =   '已取消收藏';
            }

        }

        return response()->json($data);

    }
}