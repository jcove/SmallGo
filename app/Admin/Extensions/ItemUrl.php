<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/18
 * Time: 下午5:51
 */

namespace App\Admin\Extensions;


use Encore\Admin\Form\Field\Url;

class ItemUrl extends Url
{
    protected $rules                        =   '';

    public function render()
    {
        $this->script = <<<EOT
        $('#item_url').on('blur',function(){
            if($('.title').val()==''){
                var url                     =   $(this).val();
                var reg                     =   /(&|\?)id=\d*/gi;
                var arr                     =   url.match(reg);
                if(arr){
                 var id                      =   arr[0].replace(/(&|\?)id=/,'');    
    
                 $.ajax({
                      url: "/taobao/item/"+id,
                      dataType: 'json',
                      success: function(result) {
                          if(result.title){
                              $('#title').val(result.title);
                              $('#price').val(result.price);
                              $('#name').val(result.title);
                              $('#original_id').val(result.original_id);
                              $('#item_url').val(result.item_url);
                              
                              var taobaoReg         =   new RegExp(/*taobao*/);
                              if(taobaoReg.test(url)){
                                $('#from_site').val('淘宝');
                              }
                              var tmallReg          =   new RegExp(/*tmall*/);
                              if(tmallReg.test(url)){
                                $('#from_site').val('天猫');
                              }   
                          }else{
                            alert('自动获取失败，请手动添加');
                          }
                          
                      }
                  });
                }
            }
        });
EOT;



        return parent::render();
    }
}