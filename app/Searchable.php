<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2017/11/16
 * Time: 10:08
 */

namespace App;


use App\Models\GoodsShare;
use Elasticsearch\ClientBuilder;

class Searchable
{

    private $client;
    private $index;
    /**
     * Searchable constructor.
     */
    public function __construct()
    {
        $this->client                               =   ClientBuilder::create()->setHosts(config('cs.hosts'))->build();
        $this->index                                =   config('es.index');

    }

    public function searchAbleArray(){
        return null;
    }

    public function create(){
        $params = [
            'index' => config('es.index'),
            'body' => [
                'settings' => [
                    'number_of_shards' => 2,
                    'number_of_replicas' => 0
                ]
            ]
        ];
        $response = $this->client->indices()->create($params);
    }
    public function insert(GoodsShare $goodsShare){
        $params = [
            'index' =>  config('es.index'),
            'type' => 'goods',
            'id' => $goodsShare->id,
            'body' => ['title'=>$goodsShare->title,'status'=>$goodsShare->status]
        ];
//        foreach ($this->searchAbleArray() as $k =>$v){
//            $params['body'][$k]         =   $this->$v;
//        }

        $response = $this->client->index($params);
    }
    public function search($keywords){
        $from                           =   1;
        $size                           =   10;
        $from                           =   request()->from ? request()->from : 1;
        $size                           =   request()->size ? request()->size : 10;
        $params = [
            'index' => $this->index,
            'type' => 'goods',
            'from' =>$from,
            'size' =>$size,
            'body' => [
                'query' => [
                    'match' => [
                        'title' => $keywords,
                    ],
                ]
            ]
        ];

        $response = $this->client->search($params);
        if(isset($response['hits'])){
            if(isset($response['hits']['hits'])){
                $in                         =   [];
                foreach ($response['hits']['hits'] as $row){
                    $in[]                   =   $row['_id'];
                }
                return $in;
            }
        }
        return null;
    }
    public function delete(GoodsShare $goodsShare){
        $params = [
            'index' => 'goods',
            'type' => 'goods',
            'id' => $goodsShare->id
        ];

// Delete doc at /my_index/my_type/my_id
        $response = $this->client->delete($params);
        return $response;
    }

    public function get($id){
        $params = [
            'index' => 'goods',
            'type' => 'goods',
            'id' => $id
        ];

        $response = $this->client->get($params);
        return $response;
    }
    public function update(GoodsShare $goodsShare){
        $params = [
            'index' => 'goods',
            'type' => 'goods',
            'id' => $goodsShare->id,
            'body' => [
                'doc' => [
                    'title' => $goodsShare->title,
                    'status'=>$goodsShare->status
                ]

            ]
        ];

        $response = $this->client->update($params);
        return $response;
    }
    public function exist(){
        $params = [
            'index' => 'goods',
        ];
        return $this->client->indices()->exists($params);
    }
}