<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/18
 * Time: 下午5:51
 */

namespace App\Admin\Extensions;


use Encore\Admin\Form\Field\Url;

class CouponUrl extends Url
{
    protected $rules                    =   '';
    public function render()
    {
        $this->script = <<<EOT
         $('#coupon_click_url').on('blur',function(){ 
              var url                     =   $(this).val();
              url                         =   url.replace(/coupon\/edetail/ig, "cp/coupon");

                 $.ajax({
                      url: url,
                      dataType: 'jsonp',
                      jsonp: 'callback',
                      success: function(result) {
                          if (result.status == '1111') {
                              alert('啊噢！阿里妈妈访问限制啦请切换IP或者等待几分钟')
                              return;
                          }
                          console.log(result);
                          $('#coupon_amount').val(result.result.amount);
                          $('#coupon_start_time').val(result.result.effectiveStartTime);
                          $('#coupon_end_time').val(result.result.effectiveEndTime);
                          $('#coupon_start_fee').val(result.result.startFee);
                         
                          $('.coupon_status').val(result.result.retStatus==0 ? 1:0);
                      
                          $('#coupon_click_url').val('https:'+result.result.item.shareUrl);
                          
                           var reg                      =   /e=([a-zA-Z0-9]|%)*/;
                           var arr                      =   result.result.item.shareUrl.match(reg);
                           if(arr){
                               var me                       =   arr[0].replace(/e=/,'');    
                               $.ajax({
                                  url: "/taobao/coupon/"+encodeURI(me),
                                  dataType: 'json',
                                  success: function(result) {
                                      console.log(result);
                                      $('#coupon_remain_count').val(result.data.coupon_remain_count);
                                     
                                  }
                               });
                           }
                       }
                  });
        });

       

EOT;



        return parent::render();
    }
}