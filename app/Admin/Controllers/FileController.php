<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2018/1/30
 * Time: 9:56
 */

namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;

class FileController extends Controller
{
    public function aether(){
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('上传淘宝联盟下载的excel,系统会每十分钟一次自动导入到数据库');

            $content->body(view('admin.aetherupload'));
        });
    }

}