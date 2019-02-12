<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/18
 * Time: 下午3:29
 */

namespace App\Http\Controllers;


use App\Common\TaoBao;
use App\Models\Category;
use App\Models\GoodsShare;
use GenPwdIsvParamDto;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Log;
use TbkCouponGetRequest;
use TbkDgItemCouponGetRequest;
use TbkItemInfoGetRequest;
use TbkUatmFavoritesGetRequest;
use TopClient;
use WirelessShareTpwdCreateRequest;

class TaobaoController extends Controller
{
    public function coupon($me){

        $c = new TopClient( config('taobao.app_key'),config('taobao.app_secret'));

        $req                            =   new TbkCouponGetRequest();
        $req->setMe($me);
        $resp = $c->execute($req);
        return response()->json($resp);
    }

    public function item($id){

        if(empty($id) ){
            $this->error='非法的num_iid';
            return false;
        }
        $taobao                                 =   new TaoBao();
        $goods                                  =   $taobao->item($id);
        if(!$goods){
            return response()->json(['status'=>false,'msg'=>$taobao->getError()]);
        }
        return response()->json($goods);
    }

    public function openApp(){
        $url                                    =   request()->url;;
        if($this->isWeChatBrowser(request())){
            $contents = view('mobile.taobao.open_app')->with('url', $url);
            $response = \response($contents,200);
            $response->header('Content-Type', 'application/vnd.ms-word;Charset=UTF-8')
                ->header('content-disposition','attachment; filename=shopping.doc');
            return $response;
        }else{
            $data['url']                        =   $url;
            return smallgo_view('taobao.open_app',$data);
        }
    }

    public function saveClientCollect(){
        $request                                    =   request();
        $numIid                                     =   $request->num_iid;
        if(empty($numIid)){
            return \response(['status'=>'fail','message'=>'num_iid必须']);
        }
        $categoryId                                 =   $request->category_id;
//        if(empty($categoryId)){
//            return \response(['status'=>'fail','message'=>'请选择分类']);
//        }
        $channelId                                  =   $request->channel_id;
        $goods                                      =   GoodsShare::getByNumIid($numIid);
        if(empty($goods)){
            $goods                                  =   new GoodsShare();
            $goods->name                            =   $request->title;
            $goods->cover                           =   $request->pict_url;
            $goods->title                           =   $request->title;
            $goods->item_url                        =   $request->item_url;
            $goods->original_id                     =   $request->num_iid;
            $taobao                                 =   new TaoBao();
            $item                                   =   $taobao->item($request->num_iid);

            $goods->pictures                        =   $request->pictures ? $request->pictures : (isset($item['pictures']) ? $item['pictures'] : '');
            $goods->from_site                       =   '淘宝';
        }
        $goods->price                               =   $request->zk_final_price;
        $goods->status                              =   $request->status;

        if(empty($goods->click_url)){
            $goods->click_url                       =   $request->click_url;
        }

        if(!empty($request->coupon_click_url)){
            $goods->coupon_click_url                =   $request->coupon_click_url;
            $goods->coupon_start_time               =   $request->coupon_start_time;
            $goods->coupon_end_time                 =   $request->coupon_end_time;
            $goods->coupon_status                   =   1;
            $goods->coupon_remain_count                   =   $request->coupon_remain_time;

        }
        if(isset($request->coupon_info) && !empty($request->coupon_info)){
            preg_match_all('/\d+/', $request->coupon_info, $matches);

            if($matches){
                if(isset($matches[0][1])){
                    $goods->coupon_amount               =   $matches[0][1];
                }
                if(isset($matches[0][0])){
                    $goods->coupon_start_fee            =   $matches[0][0];
                }

            }else{
                $goods->coupon_amount  =   0;
            }
        }
        $goods->volume                              =   $request->volume;
        $goods->coupon_remain_count                 =   $request->coupon_remain_count;
        $goods->category_id                         =   $categoryId ? $categoryId :  0;
        $goods->channel_id                          =   $channelId ? $channelId : 0;
        $goods->tpwd                                =   $request->tpwd ? $request->tpwd : '';
        $goods->save();
        return response()->json(['status'=>'success','id'=>$goods->id]);

    }

    protected function isWeChatBrowser($request)
    {
        return strpos($request->header('user_agent'), 'MicroMessenger') !== false;
    }

    public function recommend(){
        $numIid                                 =   request()->num_iid;
        if($numIid){
            $taobao                                 =   new TaoBao();
            $data['recommend_goods_list']           =   $taobao->recommend($numIid);
            return smallgo_view('taobao.recommend',$data);
        }else{
            return '无相关推荐';
        }

    }



}
