<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2018/1/19
 * Time: 16:02
 */

namespace App\Http\Controllers;



use GuzzleHttp\Client;

class TestController extends Controller
{
    public function index(){
        $client = new Client();
        $str                                    =   '为了提供更加稳定可靠的服务';
        $res = $client->request('POST', 'http://api.bosonnlp.com/tag/analysis',[
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept'     => 'application/json',
                'X-Token'      => 'IcabFlUp.23545.kXTna1whRsfq'
            ],
            'body'=>json_encode([$str])
        ]);
        $body                                   =   (string)$res->getBody();
        $json                                   =   \GuzzleHttp\json_decode($body,true);
        dump($json);
        if($json){
            $word                               =   $json[0]['word'];
            $word                               =   implode(',',$word);
            echo $word;
        }
    }
}