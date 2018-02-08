<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/18
 * Time: 下午3:30
 */
return [
    'goods_update_cycle'        =>  env('goods_update_cycle','1'),//商品信息自动更新周期,单位为天，只在详情页被打开时更新，只更新商品基本信息，不更新优惠券信息，请知晓
];