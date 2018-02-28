<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/26
 * Time: 19:26
 */

namespace App\Http\Controllers;


use App\Models\Channel;
use App\Models\GoodsShare;
use App\Models\Recommend;



class ChannelController extends Controller
{
    public function channel($id,$sort='id',$desc='desc'){
        $list                                   =   GoodsShare::where(['channel_id'=>$id,'status'=>1])->orderBy($sort,$desc)->paginate(16);
        $list->setCollection(GoodsShare::setCouponPrice($list->getCollection()));
        $data['list']                           =   $list;
        $recommendInfo                          =   Channel::info($id);
        $data['title']                          =   $recommendInfo['name'];
        $data['id']                             =   $id;
        $data['sort']                           =   $sort;
        $data['desc']                           =   $desc=='desc' ? 'asc' : 'desc';
        return smallgo_view('channel.goods',$data);
    }
    public function options(){
        $data                                   =    Channel::allSelectOptions();
        $list                                   =   [];
        foreach ($data as $k =>$v){
            $list[]                             =   ['id'=>$k,'name'=>$v];
        }
        return $list;
    }

}