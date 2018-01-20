<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2017/11/25
 * Time: 11:52
 */

namespace App\Listeners;


use App\Models\User;
use Illuminate\Support\Facades\Log;
use Overtrue\LaravelWechat\Events\WeChatUserAuthorized;

class WeChatAuthorized
{
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param PodcastWasPurchased $event
     * @return void
     */
    public function handle(WeChatUserAuthorized $event)
    {


            $wechatUser                         =   $event->user;
            $user                               =   User::getByWechatId($wechatUser->original['unionid']);
            if(empty($user)){
                $user                           =   new User();
                $user->nick                     =   $wechatUser->nickname;
                $user->avatar                   =   $wechatUser->avatar;
                $user->position                 =   $wechatUser->original['country'];
                $user->wechat_id                =   $wechatUser->original['unionid'];
                $user->sex                       =  $wechatUser->original['sex'];
                $user->save();
            }
            session(['login_user_id'=>$user->id]);


    }

}