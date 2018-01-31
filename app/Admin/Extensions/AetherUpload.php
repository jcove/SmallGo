<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2018/1/30
 * Time: 9:49
 */

namespace App\Admin\Extensions;


use Encore\Admin\Form\Field;

class AetherUpload extends Field
{
    protected $view = 'admin.aetherupload';

    protected static $css = [

    ];

    protected static $js = [
        '/js/spark-md5.min.js',
        'js/aetherupload.js'
    ];

    public function render()
    {
        return parent::render();
    }
}