<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/24
 * Time: 上午10:01
 */

namespace App\Admin\Controllers;


use App\Models\Category;
use App\Models\Channel;
use App\Models\GoodsShare;
use Encore\Admin\Layout\Content;
use Illuminate\Support\MessageBag;
use TbkUatmFavoritesGetRequest;
use TbkUatmFavoritesItemGetRequest;
use TopClient;

class TaobaoController
{
    public function update(){
        if(request()->isMethod('get')){
            $content                        =   new Content(function (Content $content){
                $content->header('header');
                $content->description('description');

                $content->body($this->form());
            });
            return $content;
        }

        if(request()->isMethod('post')){
            $favoritesId                    =   request()->favorites_id;
            return redirect()->route('taobao_execute_update',['favorites_id'=>$favoritesId]);
        }

    }
    public function executeUpdate($favoritesId,$pageNo=1){
        $c                              =   new TopClient( config('taobao.app_key'),config('taobao.app_secret'));
        $c->format                      =   'json';
        $req                            =   new TbkUatmFavoritesItemGetRequest();
        $req->setPlatform("1");
        $req->setPageSize("20");
        $req->setAdzoneId( config('taobao.ad_zone_id'));
        $req->setFavoritesId($favoritesId);
        $req->setPageNo($pageNo);
        $req->setFields("num_iid,title,pict_url,small_images,reserve_price,zk_final_price,coupon_click_url,coupon_start_time,item_url,seller_id,coupon_end_time,coupon_remain_count,coupon_info,click_url,status,volume");
        $resp = $c->execute($req);

        if($resp){

            $total                      =   $resp->total_results;
            $pageTotal                  =   $total/20;
            $list                       =   $resp->results->uatm_tbk_item;
            $favorites                              =   session('favorites');
            $category                                   =   null;
            if($favorites){
                $categoryName                           =   $favorites[$favoritesId];
                $array                                  =   explode('-',$categoryName);
                //是否推荐商品
                if(strpos($categoryName,'推荐') || strpos($categoryName,'频道')){
                    $channel                            =   Channel::getByName($array[0]);
                }
                $parent                                 =   Category::getByName($array[0]);
                if($parent){
                    if(!isset($array[2])){
                        $category                       =   $parent;
                    }else{
                        $category                       =   Category::getByParentIdAndName($parent->id,$array[1]);
                    }

                }

            }
            foreach ($list as $k=>$v){
                $list[$k]->_token                       =   csrf_token();
                if($category){
                    $list[$k]->category_id              =   $category->id;
                }
                //是否推荐商品
                if(isset($channel) && !empty($channel)){
                    $list[$k]->channel_id               =   $channel->id;
                }
            }
            $data['page_no']            =   $pageNo;
            $data['list']               =   $list;
            $data['page_total']         =   ceil($pageTotal);
            $data['total']              =   $total;
            $data['next_page_url']      =   '';
            if($data['page_total']!=$pageNo){
                $data['next_page_url']  =   url('admin/taobao/executeUpdate',['favorites_id'=>$favoritesId,'page_no'=>$pageNo+1])   ;
            }

            return view('admin.taobao.execute_update',$data);
        }

    }
    public function form(){
        $data['favorites']                          =   $this->favorites();
        try {
            return view('admin.taobao.update', $data)->render();
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function executeOne($text=''){
        $request                                    =   request();
        $goods                                      =   GoodsShare::getByNumIid($request->num_iid);

        if(empty($goods)){
            if(isset($request->recommend_id)){
                $goods                              =   new GoodsShare();
            }else{
                $goods                              =   new GoodsShare();
            }

            $goods->name                            =   $request->title;
            $goods->cover                           =   $request->pict_url;
            $goods->title                           =   $request->title;
            $goods->item_url                        =   $request->item_url;
            $goods->setPicturesAttribute($request->small_images['string']);
            $goods->original_id                     =   $request->num_iid;
        }
        if(isset($request->channel_id)){
            $goods->channel_id                      =   $request->channel_id;
        }else{
            $goods->category_id                     =   $request->category_id;
        }

        $goods->price                               =   $request->zk_final_price;
        $goods->status                              =   $request->status;

        if(empty($goods->click_url)){
            $goods->click_url                       =   $request->click_url;
        }
        $url                                        =   $goods->click_url;
        if(!empty($request->coupon_click_url)){
            $goods->coupon_click_url                =   $request->coupon_click_url;
            $goods->coupon_start_time               =   $request->coupon_start_time;
            $goods->coupon_end_time                 =   $request->coupon_end_time;
            $goods->coupon_status                   =   1;
            $goods->coupon_amount                   =   $request->coupon_amount;
            $goods->coupon_start_fee                =   $request->coupon_start_fee;
            $url                                    =   $goods->coupon_click_url;
        }
        $goods->volume                              =   $request->volume;
        $goods->coupon_remain_count                 =   $request->coupon_remain_count ?$request->coupon_remain_count : 0;
        $goods->save();
        return new MessageBag();
    }

    public function favorites(){
        $c                                          =   new TopClient( config('taobao.app_key'),config('taobao.app_secret'));
        $c->format                                  =   'json';
        $req                                        =   new TbkUatmFavoritesGetRequest();
        $req->setPageNo("1");
        $req->setPageSize("100");
        $req->setFields("favorites_title,favorites_id,type");
        $resp = $c->execute($req);
        if($resp){
            session('fav');
            foreach ($resp->results->tbk_favorites as $row){
                $favourites[$row->favorites_id]     =   $row->favorites_title;
            }
            session(['favorites'=>$favourites]);
            return $resp->results->tbk_favorites;
        }
    }
}