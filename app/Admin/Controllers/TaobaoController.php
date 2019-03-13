<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/24
 * Time: 上午10:01
 */

namespace App\Admin\Controllers;


use App\Common\TaoBao;
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
    public function selection()
    {
        if (request()->isMethod('get')) {
            $content  =  new Content(function (Content $content) {
                $content->header('商品更新');
                $content->description('商品更新是基于淘宝联盟选品库更新，选品库的命名规则为:一级分类名称-二级分类名称-1，例如：服装-女装-1，后面的数字用于将多个选品库合并到一个，因为淘宝联盟对选品库的选品组有限制，每个选品组最多包含200个商品，很显然一个选品组不能满足我们对分类的需求，因此后面加了数字角标，将多个选品组合并成一个分类');

                $content->body($this->form());
            });
            return $content;
        }

        // 重定向，设置favorites_id为选品库ID
        $favoritesId = request()->favorites_id;
        // return redirect()->route('taobao.execute_update', ['favorites_id' => $favoritesId]);
    }

    /**
     * 更新选品库商品
     *
     * @param integer $favoritesId
     * @param integer $pageNo
     * @return void
     */
    public function executeUpdate()
    {
        $favoritesId = request()->input('favorites_id');
        $pageNo = request()->input('page_no', 1);

        $taobao                         =   new TaoBao();
        $list                           =   $taobao->favourite($favoritesId, $pageNo);
        if ($list) {

            $total                                      =   $taobao->getTotal();
            $pageTotal                                  =   $taobao->getPages();
            $favorites                                  =   $this->favoritesArr();
            $category                                   =   null;
            if ($favorites) {
                $categoryName                           =   $favorites[$favoritesId];
                $array                                  =   explode('-', $categoryName);
                //是否推荐商品
                if (strpos($categoryName, '推荐') || strpos($categoryName, '频道')) {
                    $channel                            =   Channel::getByName($array[0]);
                }
                $parent                                 =   Category::getByName($array[0]);
                if ($parent) {
                    if (!isset($array[2])) {
                        $category                       =   $parent;
                    } else {
                        $category                       =   Category::getByParentIdAndName($parent->id, $array[1]);
                    }
                }
            }
            foreach ($list as $k => $v) {
                if ($category) {
                    $list[$k]->category_id              =   $category->id;
                }
                //是否推荐商品
                if (isset($channel) && !empty($channel)) {
                    $list[$k]->channel_id               =   $channel->id;
                }
                $goods                                  =   GoodsShare::getByNumIid($v->original_id);
                if (!empty($goods)) {
                    $v->id                              =   $goods->id;
                    $v->exists                          =   true;
                }
                $v->save();
            }
            $data['page_no']            =   $pageNo;
            $data['list']               =   $list;
            $data['page_total']         =   ceil($pageTotal);
            $data['total']              =   $total;
            $data['next_page_url']      =   '';
            $data['favorites_id']       =   $favoritesId;
            if ($data['page_total'] != $pageNo) {
                $data['next_page_url']  =   url('admin/taobao/executeUpdate', ['favorites_id' => $favoritesId, 'page_no' => $pageNo + 1]);
            }
        }
        // 加入选品库数组
        $data['favorites'] = $this->favorites();
        return view('admin.taobao.execute_update', $data);
    }

    /**
     * 渲染Form
     *
     * @return void
     */
    public function form()
    {
        $data['favorites']                          =   $this->favorites(true);
        try {
            return view('admin.taobao.update', $data)->render();
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function executeOne()
    {
        $request                                    =   request();
        $goods                                      =   GoodsShare::getByNumIid($request->num_iid);

        if (empty($goods)) {
            if (isset($request->recommend_id)) {
                $goods                              =   new GoodsShare();
            } else {
                $goods                              =   new GoodsShare();
            }

            $goods->name                            =   $request->title;
            $goods->cover                           =   $request->pict_url;
            $goods->title                           =   $request->title;
            $goods->item_url                        =   $request->item_url;
            $goods->setPicturesAttribute($request->small_images['string']);
            $goods->original_id                     =   $request->num_iid;
        }
        if (isset($request->channel_id)) {
            $goods->channel_id                      =   $request->channel_id;
        } else {
            $goods->category_id                     =   $request->category_id;
        }

        $goods->price                               =   $request->zk_final_price;
        $goods->status                              =   $request->status;

        if (!empty($request->click_url)) {
            $goods->click_url                       =   $request->click_url;
        }

        if (!empty($request->coupon_click_url)) {
            $goods->coupon_click_url                =   $request->coupon_click_url;
            $goods->coupon_start_time               =   $request->coupon_start_time;
            $goods->coupon_end_time                 =   $request->coupon_end_time;
            $goods->coupon_status                   =   1;
            $goods->coupon_amount                   =   $request->coupon_amount;
            $goods->coupon_start_fee                =   $request->coupon_start_fee;
        }
        $goods->volume                              =   $request->volume;
        $goods->coupon_remain_count                 =   $request->coupon_remain_count ? $request->coupon_remain_count : 0;
        $goods->save();
        return new MessageBag();
    }

    /**
     * 查询选品库列表，存到cache
     *
     * @return void
     */
    public function favorites($force = false)
    {
        $favorites = cache('favorites', []);

        if (empty($favorites) || $force) {
            $c                                          =   new TopClient(config('taobao.app_key'), config('taobao.app_secret'));
            $c->format                                  =   'json';
            $req                                        =   new TbkUatmFavoritesGetRequest();
            $req->setPageNo("1");
            $req->setPageSize("100");
            $req->setFields("favorites_title,favorites_id,type");
            $resp = $c->execute($req);

            if ($resp) {
                cache(['favorites' => $resp->results->tbk_favorites], 5);
                return $resp->results->tbk_favorites;
            }
            
        }
        return $favorites;

    }

    /**
     * 取出数组化的选品库数据
     */
    public function favoritesArr()
    {
        $obj = $this->favorites();
        if (empty($obj)) {
            return [];
        }

        foreach ($obj as $key => $value) {
            $favorites[$value->favorites_id] = $value->favorites_title;
        }

        return $favorites;
    }
}

