<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/9
 * Time: 下午5:24
 */

namespace App\Admin\Controllers;


use App\Models\Tag;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Tree;
use Encore\Admin\Tree\Tools;
use Encore\Admin\Widgets\Collapse;

class RecommendController
{
    use ModelForm;
    public function ajax(){
        $Recommend                               =   new Tag();
        $recommends                             =   $Recommend->getAllRecommend();
        foreach ($recommends as  $recommend){
            $array['id']                        =   $recommend->id;
            $array['text']                      =   $recommend->name;
            $data[]                             =   $array;
        }
        return response()->json($data);
    }

    public function index(){
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }
    protected function treeView()
    {
        return Tag::tree(function (Tree $tree) {
            $tree->disableCreate();

            $tree->branch(function ($branch) {
                $payload = "<i class='fa {$branch['cover']}'></i>&nbsp;<strong>{$branch['name']}</strong>";

                if (!isset($branch['children'])) {

                    $payload .= "&nbsp;&nbsp;&nbsp;";
                }

                return $payload;
            });
        });
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Tag::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('名称');
            $grid->cover('封面')->display(function ($cover){
                return "<img style='width:50px;' src='".asset('uploads/'.$cover)."'>";
            });
            $grid->created_at();
            $grid->updated_at();
        });
    }
    protected function form()
    {
        return Admin::form(Tag::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name','名称');
            $form->image('cover','封面');
            $form->select('parent_id', '上级分类')->options(Tag::selectOptions());
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
}