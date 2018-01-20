<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/17
 * Time: 下午1:44
 */

namespace App\Admin\Extensions;


use Encore\Admin\Form\Field;

class MultiImage extends Field
{
    protected $view = 'admin.multi-image';

    protected static $css = [
        'webuploader/dist/webuploader.css',
        'webuploader/examples/image-upload/style.css',
    ];

    protected static $js = [
        'webuploader/dist/webuploader.js',
        'admin/js/upload.js'
    ];

    public function render()
    {
        $this->script = <<<EOT
    var uploadUrl = "{{ url('file/uploadPicture') }}"
        var li=$('.filelist').find('li');
        var btns=$('.file-panel');
        li.on( 'mouseenter', function() {
            btns.stop().animate({height: 30});
        });

        li.on( 'mouseleave', function() {
            btns.stop().animate({height: 0});
        });
        btns.on( 'click', 'span', function() {
            var index = $(this).index(),
                deg;

            switch ( index ) {
                case 0:
                    $(this).parent().parent().off().find('.file-panel').off().end().remove();
                    if($('.filelist').find('li').length===0){
                        $('.placeholder' ).removeClass( 'element-invisible' );
                        initUpload();
                    }
                    return;

            }
        });

EOT;

        return parent::render();
    }
}