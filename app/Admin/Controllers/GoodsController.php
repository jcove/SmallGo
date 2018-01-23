<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/16
 * Time: 下午3:22
 */

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Channel;
use App\Models\GoodsShare;
use App\Models\GoodsTag;
use App\Models\Tag;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use function foo\func;

class GoodsController
{
    use ModelForm;
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
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
        return Admin::grid(GoodsShare::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('名称');
            $grid->price('价格');
            $grid->category_id('分类')->display(function ($categoryId){
                return Category::getName($categoryId);
            });
            $grid->cover('封面')->image();
            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        return Admin::form(GoodsShare::class, function (Form $form) {
           // $form->tag                          =   GoodsTag::tags($form->id);
            $form->display('id', 'ID');
            $form->text('original_id','宝贝Id')->placeholder("原商城商品的Id，例，淘宝为id=540126528746");
            $form->itemUrl('item_url','宝贝链接');
            $form->text('tpwd','淘口令');
            $form->url('click_url', '推广链接')->placeholder('联盟后台生成的推广链接');

            $form->couponUrl('coupon_click_url','优惠券链接')->placeholder('如无，可不填写');
            $form->text('name','商品名称')->placeholder('填写宝贝链接后自动获取');
            $form->image('cover','封面');
            $form->multipleImage('pictures','相册')->removable();;

            $form->text('coupon_amount','优惠券金额')->placeholder('填写优惠券链接后自动获取');
            $form->datetime('coupon_start_time','优惠券开始时间')->placeholder('填写优惠券链接后自动获取');
            $form->datetime('coupon_end_time','优惠券结束时间')->placeholder('填写优惠券链接后自动获取');
            $form->text('coupon_remain_count','优惠券剩余数量')->placeholder('填写优惠券链接后自动获取');
            $form->select('category_id','分类')->options(Category::allSelectOptions());
            $form->select('channel_id','频道')->options(Channel::allSelectOptions());
            $form->text('from_site','宝贝来源网站')->placeholder('填写宝贝链接后自动获取');
            $form->text('price','价格')->placeholder('填写宝贝链接后自动获取');

            $form->text('title', 'SEO标题')->placeholder('显示在网页标题，填写宝贝链接后自动获取');
            $form->text('keywords', 'SEO关键词');
            $form->text('description', 'SEO描述');
           // $form->multipleSelect('tag','标签')->options(Tag::selectOptions());
            $form->hidden('coupon_status','优惠券状态');
            $form->editor('detail','详情');
            $form->saving(function (Form $form){
               if(empty($form->tpwd)){
                   $url                                 =   $form->coupon_click_url ? $form->coupon_click_url : $form->click_url;
                   $tpwd                                =   GoodsShare::getTpwd($url,$form->title);
                   $form->tpwd                          =   $tpwd;
               }
            });
        });
    }


}