<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/9
 * Time: 下午5:24
 */

namespace App\Admin\Controllers;


use App\Models\Channel;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Tree;


class ChannelController
{
    use ModelForm;
    public function ajax(){
        $Channel                               =   new Channel();
        $channels                             =   $Channel->getAllChannel();
        foreach ($channels as  $channel){
            $array['id']                        =   $channel->id;
            $array['text']                      =   $channel->name;
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
        return Channel::tree(function (Tree $tree) {
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
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Channel::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('名称');
            $grid->hidden('前台显示')->display(function ($hidden){
                switch ($hidden){
                    case 0:
                        return '是';
                    case 1:
                        return '否';
                }
            });
            $grid->created_at();
            $grid->updated_at();
        });
    }
    protected function form()
    {
        return Admin::form(Channel::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->text('name','名称');
            $form->text('order','排序')->placeholder('1-100数字，升序排列')->help('1-100数字，升序排列');
            $form->select('hidden','前台显示')->options([0=>'是',1=>'否']);
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