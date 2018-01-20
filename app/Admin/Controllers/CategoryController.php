<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/9
 * Time: 下午5:24
 */

namespace App\Admin\Controllers;


use App\Models\Category;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Tree;
use Encore\Admin\Tree\Tools;
use Encore\Admin\Widgets\Collapse;

class CategoryController
{
    use ModelForm;
    public function ajax(){
        $Category                               =   new Category();
        $categories                             =   $Category->getAllCategory();
        foreach ($categories as  $category){
            $array['id']                        =   $category->id;
            $array['text']                      =   $category->name;
            $data[]                             =   $array;
        }
        return response()->json($data);
    }

    public function index(){
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');
            $content->row(function (Row $row) {
                $row->column(6, '<div class="btn-group pull-right" style="margin-right: 10px">
    <a href="/admin/category/create" class="btn btn-sm btn-success">
        <i class="fa fa-save"></i>&nbsp;&nbsp;New
    </a>
</div>');
            });
            $content->row(function (Row $row) {
                $row->column(6, $this->treeView()->render());
            });
        });
    }
    protected function treeView()
    {
        return Category::tree(function (Tree $tree) {
            $tree->disableCreate();

            $tree->branch(function ($branch) {
                $payload = "<i class='fa {$branch['icon']}'></i>&nbsp;<strong>{$branch['name']}</strong>";

                if (!isset($branch['children'])) {

                    $payload .= "&nbsp;&nbsp;&nbsp;";
                }

                return $payload;
            });
        });
    }

    protected function form()
    {
        return Admin::form(Category::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name','名称');
            $form->categoryIcon('icon','图标');
            $form->select('parent_id', '上级分类')->options(Category::selectOptions());
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