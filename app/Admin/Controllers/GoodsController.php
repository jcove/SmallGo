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
use Illuminate\Validation\Rule;


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

            $states = [
                'on'  => ['value' => 1, 'text' => '是', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '否', 'color' => 'default'],
            ];
            $grid->is_recommend('推荐')->switch($states);
            $grid->category_id('分类')->editable('select', Category::allSelectOptions())->sortable();
            $grid->cover('封面')->image();
            $grid->created_at();
            $grid->updated_at();
            $grid->filter(function($filter){
                // 在这里添加字段过滤器
                $filter->equal('category_id')->select(Category::allSelectOptions());
            });
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
            $form->text('original_id','宝贝Id')->placeholder("原商城商品的Id，例，淘宝为id=540126528746");//->rules('required|'.Rule::unique('goods_shares')->ignore($form->id));
            $form->itemUrl('item_url','宝贝链接')->rules('required');
            $form->text('tpwd','淘口令')->default('');
            $form->text('click_url', '推广链接')->placeholder('联盟后台生成的推广链接')->rules('required')->default('');;

            $form->text('coupon_click_url','优惠券链接')->placeholder('如无，可不填写')->default('');
            $states = [
                'on'  => ['value' => 1, 'text' => '是', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '否', 'color' => 'default'],
            ];

            $form->switch('is_recommend','推荐')->states($states)->default(0);
            $form->text('name','商品名称')->placeholder('填写宝贝链接后自动获取')->rules('required');;
            $form->image('cover','封面')->options(['autoReplace'=>true]);
            $form->multipleImage('pictures','相册')->removable();;

            $form->text('coupon_amount','优惠券金额')->placeholder('优惠券金额')->default(0);
            $form->datetime('coupon_start_time','优惠券开始时间')->placeholder('优惠券开始时间');
            $form->datetime('coupon_end_time','优惠券结束时间')->placeholder('优惠券结束时间');
            $form->text('coupon_remain_count','优惠券剩余数量')->placeholder('优惠券剩余数量')->default(0);
            $form->select('category_id','分类')->options(Category::allSelectOptions())->default(0);
            $form->select('channel_id','频道')->options(Channel::allSelectOptions())->default(0);
            $form->text('from_site','宝贝来源网站')->placeholder('填写宝贝链接后自动获取')->default('');
            $form->text('price','价格')->placeholder('填写宝贝链接后自动获取')->default(0.0);

            $form->text('title', 'SEO标题')->placeholder('显示在网页标题，填写宝贝链接后自动获取')->default('');
            $form->text('keywords', 'SEO关键词')->default('');
            $form->text('description', 'SEO描述')->default('');
           // $form->multipleSelect('tag','标签')->options(Tag::selectOptions());
            $form->hidden('coupon_status','优惠券状态')->default(0);
            $form->editor('detail','详情')->default('');
            $form->saving(function (Form $form) {
                if(null==$form->tpwd){
                    $form->tpwd                                 =   '';
                }
                if(null==$form->keywords){
                    $form->keywords                             =   '';
                }
                if(null==$form->description){
                    $form->description                          =   '';
                }
                if(null==$form->detail){
                    $form->detail                               =   '';
                }
                if(null==$form->coupon_click_url){
                    $form->coupon_click_url                     =   '';
                }
            });
        });
    }


}