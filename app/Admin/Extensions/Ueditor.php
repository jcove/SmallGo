<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/16
 * Time: 下午3:57
 */

namespace App\Admin\Extensions;


use Encore\Admin\Form\Field;

class Ueditor extends Field
{
    protected $view = 'admin.ueditor';

    protected static $css = [
        '/fonticon-picker/css/jquery.fonticonpicker.css',
        '/fonticon-picker/themes/bootstrap-theme/jquery.fonticonpicker.bootstrap.min.css',
        '/category-icon/iconfont.css'
    ];

    protected static $js = [
        'ueditor/ueditor.config.js',
        'ueditor/ueditor.all.js'
    ];
    public function render()
    {
        $this->script = <<<EOT
        var ue = UE.getEditor('container');

EOT;



        return parent::render();
    }
}