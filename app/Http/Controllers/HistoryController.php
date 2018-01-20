<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2017/11/11
 * Time: 10:20
 */

namespace App\Http\Controllers;


use App\Models\History;

class HistoryController extends Controller
{
    public function history(){
        $data['list']                           =   History::history();
        $data['title']                          =   '浏览历史';
        return $this->view('user.history',$data);
    }
}