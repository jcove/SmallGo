<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/20
 * Time: 下午2:51
 */

namespace App\Http\Controllers;


use App\Common\TaoBao;
use App\Models\GoodsShare;
use App\Searchable;
use TbkDgItemCouponGetRequest;
use TopClient;

class SearchController extends Controller
{
    public function goods($keywords='',$sort='view',$desc='desc'){
        $keywords                           =   $keywords ? $keywords :request()->keywords;
        $list                               =   [];
        if(!empty($keywords)){
        //    $list                           =   GoodsShare::where(['status'=>1])->search($keywords,null,true)->orderBy($sort,'desc')->paginate(9);
            $list                           =   GoodsShare::search($keywords)->where(['status'=>1])->orderBy($sort,$desc)->paginate(10);
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
        return smallgo_view('search.goods',$data);
    }

    public function coupon($keywords=''){
        $keywords                       =   $keywords ? $keywords : request()->keywords;
        $page                           =   request()->page;
        $nextPageUrl                    =   '';
        if(!empty($keywords)){
            $taobao                     =   new TaoBao();
            $result                     =   $taobao->searchCoupon($keywords);
            if($result){
                if($page<$result->lastPage()){
                    $nextPageUrl        =   url('search/coupon',['keywords'=>$keywords]);
                }
                $data['list']           =   $result;
            }
        }
        $data['keywords']               =   $keywords;
        $data['title']                  =   '找券';
        $data['next_page_url']          =   isset($nextPageUrl) ? $nextPageUrl : '';
        return smallgo_view('search.coupon',$data);
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