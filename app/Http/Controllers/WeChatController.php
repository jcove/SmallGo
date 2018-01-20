<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2017/11/25
 * Time: 10:53
 */

namespace App\Http\Controllers;




class WeChatController
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {


        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
            return "欢迎关注 overtrue！";
        });

        return $wechat->server->serve();
    }
}