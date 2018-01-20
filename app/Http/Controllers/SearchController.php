<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/20
 * Time: 下午2:51
 */

namespace App\Http\Controllers;


use App\Models\GoodsShare;
use App\Searchable;
use Elasticsearch\ClientBuilder;
use TbkDgItemCouponGetRequest;
use TopClient;

class SearchController extends Controller
{
    public function goods($keywords='',$sort='view',$desc='desc'){
        $keywords                           =   $keywords ? $keywords :request()->keywords;
        $list                               =   [];
        if(!empty($keywords)){
        //    $list                           =   GoodsShare::where(['status'=>1])->search($keywords,null,true)->orderBy($sort,'desc')->paginate(9);
            $list                           =   GoodsShare::where(['status'=>1])->where('title','like','%'.$keywords.'%')->orderBy($sort,$desc)->paginate(10);
            if($list->getCollection()){
                $items                      =   $list->getCollection();
                $list->setCollection(GoodsShare::setCouponPrice($items));
            }
        }
        $data['list']                       =   $list;
        $data['title']                      =   $keywords;
        $data['sort']                       =   $sort;
        $data['keywords']                   =   $keywords;
        $data['desc']                       =   $desc == 'desc' ? 'asc':'desc';
        return $this->view('search.goods',$data);
    }

    public function coupon($keywords=''){
        $keywords                       =   $keywords ? $keywords : request()->keywords;
        $page                           =   request()->page;
        $list                           =   [];
        $nextPageUrl                    =   '';
        $hotGoods                       =   [];
        if(!empty($keywords)){
            $c                          =   new TopClient( config('taobao.app_key'),config('taobao.app_secret'));
            $c->format                  =   'json';
            $req                        =   new TbkDgItemCouponGetRequest();
            $req->setQ($keywords);
            $req->setAdzoneId(config('taobao.ad_zone_id'));
            $req->setPlatform('1');
            $req->setPageSize('10');
            $req->setPageNo($page);
            $resp = $c->execute($req);
            if(empty($resp->code)){
                if($resp->total_results > 0){
                    if(isset($resp->results)){
                        $list                   =   $resp->results->tbk_coupon;
                        $pages                  =   ceil($resp->total_results/10);
                        if($page<$pages){
                            $nextPageUrl        =   url('search/coupon',['keywords'=>$keywords]);
                        }
                        if($list){
                            foreach ($list as $k =>$v){
                                preg_match_all('/\d+/', $v->coupon_info, $matches);

                                if($matches){
                                    $list[$k]->coupon_amount  =   $matches[0][1];
                                }else{
                                    $list[$k]->coupon_amount  =   0;
                                }
                                $list[$k]->zk_final_price       =   floatval($v->zk_final_price);
                                $list[$k]->coupon_price       =   floatval($v->zk_final_price-$list[$k]->coupon_amount);
                            }
                        }
                    }

                }

            }
        }
        $data['list']                   =   $list;
        $data['keywords']               =   $keywords;
        $data['title']                  =   '找券';
        $data['next_page_url']          =   $nextPageUrl;
        $data['hot_goods']              =   $hotGoods;
        return $this->view('search.coupon',$data);
    }
    public function search(){
        $client                             =   ClientBuilder::create()->setHosts(config('cs.hosts'))->build();
        $params = [
            'index' => 'goods',
            'body' => [
                'settings' => [
                    'number_of_shards' => 2,
                    'number_of_replicas' => 0
                ]
            ]
        ];

      //  $response = $client->indices()->create($params);
//        $params = [
//            'index' => 'my_index',
//            'type' => 'my_type',
//            'id' => 'my_id',
//            'body' => ['title' => ' 北极绒男女加绒加厚保暖内衣套装 ']
//        ];

       // $response = $client->index($params);
//        $params = [
//            'index' => 'my_index',
//            'type' => 'my_type',
//            'body' => [
//                'query' => [
//                    'match' => [
//                        'title' => '女装'
//                    ]
//                ]
//            ]
//        ];
//
//        $response = $client->search($params);
//        $params = [
//            'index' => 'my_index',
//            'type' => 'my_type',
//            'id' => 'my_d'
//        ];
//
    //    $response = $client->get($params);
//        $Goods  =   new GoodsShare();
//        $response=$Goods->search('裤子');
        $searchable             =   new Searchable();
        $response               =   $searchable->exist();
        return $response;
    }
}