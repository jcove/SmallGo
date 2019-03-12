<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/18
 * Time: 下午3:30
 */
return [
    /*
    * Use `https`.
    */
    'secure' => env('SECURE',false),

    'goods_update_cycle'        =>  env('SITE_GOODS_UPDATE_CYCLE','1'),//商品信息自动更新周期,单位为天，只在详情页被打开时更新，只更新商品基本信息，不更新优惠券信息，请知晓
    'site_title'                =>  env('SITE_TITLE'),//网站关键词
    'site_keywords'             =>  env('SITE_KEYWORDS'),//网站关键词
    'site_description'          =>  env('SITE_DESCRIPTION'),//网站描述
    'baidu_tongji_id'           =>  env('SITE_BAIDU_TONGJI_ID'),//百度统计
    'template_pc'               =>  env('TEMPLATE_PC','default'),
    'template_mobile'           =>  env('TEMPLATE_MOBILE','default')
];