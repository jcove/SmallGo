<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2018/1/13
 * Time: 11:47
 */

namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Nav;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class NavController extends Controller
{
    use ModelForm;


    public function index(){
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    protected function grid()
    {
        return Admin::grid(Nav::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->title('标题');
            $grid->link('链接');
            $grid->created_at();
            $grid->updated_at();
        });
    }
    protected function form()
    {
        return Admin::form(Nav::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title','名称');
            $form->text('link','链接');

        });
    }
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }
}