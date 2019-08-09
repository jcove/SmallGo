<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2018/8/27
 * Time: 17:20
 */

namespace App;


class Error
{
    const order_status_error                        =   200001;
    const goods_not_choose                          =   200002;
    const comment_content_not_null                  =   200003;
    const sms_error                                 =   100002;
    const relation_data_error                       =   100003;

    //user
    const user_not_exist                            =   300003;
    const mobile_error                              =   300004;

    const return_goods_error                        =   500001;
    const return_num_error                          =   500002;
    const refund_money_error                        =   500003;
    const refund_goods_exist                        =   500004;//已申请退换货

    const region_not_support                        =   600002;
}