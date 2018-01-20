<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2017/11/30
 * Time: 10:39
 */

namespace App\Common;


use App\Models\GoodsShare;
use Illuminate\Database\Eloquent\Collection;
use TbkItemInfoGetRequest;
use TbkItemRecommendGetRequest;
use TbkTpwdCreateRequest;
use TopClient;

class TaoBao
{
    private $client;
    private $error                                      =   '商品不存在';
    /**
     * TaoBao constructor.
     */
    public function __construct()
    {
        $this->client                                   =   new TopClient( config('taobao.app_key'),config('taobao.app_secret'));
        $this->client->format                           =   'json';

    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @param string $error
     */
    public function setError(string $error)
    {
        $this->error = $error;
    }


    public function item($numIid){
        if(empty($numIid) ){
            $this->error='非法的num_iid';
            return false;
        }
        $req                                            =   new TbkItemInfoGetRequest();
        $req->setFields("num_iid,title,pict_url,small_images,zk_final_price,item_url,volume");
        $req->setNumIids($numIid);
        $resp                                           =   $this->client->execute($req);
        if(!empty($resp->results->n_tbk_item)){
            $items = $resp->results->n_tbk_item;
            foreach ($items as $row){
                return $this->itemToModel($row);
            }
            return null;
        }else{
            if(isset($resp->code)){
                $this->error        =   $resp->code;
                return false;
            }
            return null;
        }
    }

    public function tpwd($text,$url){
        $req                                =   new TbkTpwdCreateRequest;
        $req->setText($text);
        $req->setUrl($url);
        $req->setExt("{}");

        $resp                               =   $this->client->execute($req);
        if(isset($resp->code)){
            return '';
        }

        return $resp->data->model;
    }
    public function recommend($numIid){
        $req                                =   new TbkItemRecommendGetRequest;
        $req->setFields("num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,volume");
        $req->setNumIid($numIid);
        $req->setCount("20");
        $req->setPlatform("1");
        $resp = $this->client->execute($req);

        if(!empty($resp->results->n_tbk_item)){
            $items = $resp->results->n_tbk_item;
            $list                                       =   new Collection();
            foreach ($items as $row){
                $goods                                  =   $this->itemToModel($row);
                $list->add($goods);
            }
            return $list;
        }else{
            if(isset($resp->code)){
                $this->error        =   $resp->code;
                return false;
            }
            return null;
        }
    }
    protected function itemToModel($item){
        $goodsShare                         =   new GoodsShare();
        $goodsShare->id                     =   0;
        $goodsShare->name                   =   $item->title;
        $goodsShare->title                  =   $item->title;
        $goodsShare->pictures               =   isset($item->small_images->string) ? $item->small_images->string : '';
        $goodsShare->price                  =   $item->zk_final_price;
        $goodsShare->original_id            =   $item->num_iid;;
        $goodsShare->item_url               =   $item->item_url;
        $goodsShare->cover                  =   $item->pict_url;
        $goodsShare->volume                 =   $item->volume;
        return $goodsShare;
    }
}