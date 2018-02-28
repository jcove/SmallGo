<?php
/**
 * User: Administrator
 * Date: 2017/11/10
 * Time: 16:42
 */

namespace App\Http\Controllers;


use App\Models\Collection;
use App\Models\History;
use App\Models\User;

class UserController extends Controller
{
    public function my(){
        $userId                         =   session('login_user_id');
        $user                           =   User::where('id',$userId)->first();
        $data['user']                   =   $user;
        $data['title']                  =   '我的';
        return smallgo_view('user.my',$data);
    }
    public function history(){
        $userId                                 =   1;
        $data['list']                           =   History::history($userId);
        $data['title']                          =   '浏览历史';
        return smallgo_view('user.history',$data);
    }
    public function collections(){
        $userId                                 =   1;
        $data['list']                           =   Collection::collections($userId);
        $data['title']                          =   '我的收藏';
        return smallgo_view('user.collections',$data);
    }
}