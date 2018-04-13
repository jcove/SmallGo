<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/16
 * Time: 上午9:45
 */

namespace App\Admin\Extensions;


use Encore\Admin\Form\Field;

class CategoryIcon extends Field\Text
{
    protected $view = 'admin.category-icon';

    protected static $css = [
        '/fonticon-picker/css/jquery.fonticonpicker.css',
        '/fonticon-picker/themes/bootstrap-theme/jquery.fonticonpicker.bootstrap.min.css',
        '//at.alicdn.com/t/font_507260_xqcwtl6ymfxyldi.css'
    ];

    protected static $js = [
        '/fonticon-picker/jquery.fonticonpicker.min.js',
    ];

    public function render()
    {
        $this->script = <<<EOT
    var icons               =   ["iconfont icon-muyin-qinju","iconfont icon-nanshi-nanxie","iconfont icon-nvshi-peishi","iconfont icon-dianqi-peijian","iconfont icon-nvshi-jiajufu",
                                "iconfont icon-yinshi-lingshi","iconfont icon-canchu-canju","iconfont icon-yinshi-tiaoweipin","iconfont icon-nvshi-waitao","iconfont icon-canchu-chuju",
                                "iconfont icon-nvshi-lianyiqun","iconfont icon-dianqi-dianshi","iconfont icon-yinshi-baojianpin","iconfont icon-muyin-chechuangyongpin",
                                "iconfont icon-nanshi-neiyi","iconfont icon-nvshi-neiyi","iconfont icon-jiaju-jiazhuangzhucai","iconfont icon-yinshi-chongyin","iconfont icon-nanshi-waitao",
                                "iconfont icon-nanshi-xizhuang","iconfont icon-xihu-xifahufa","iconfont icon-jiaju-jujiabuyi","iconfont icon-muyin-yunchan",
                                "iconfont icon-nanshi-peishi","iconfont icon-nanshi-nanbao","iconfont icon-yinshi-jiulei","iconfont icon-nanshi-jiajufu",
                                "iconfont icon-nanshi-weiyi","iconfont icon-canchu-qingjiebaoxian","iconfont icon-yundonghuwai-jianshen","iconfont icon-yinshi-shengxian","iconfont icon-yinshi-liangyou",
                                "iconfont icon-yinshi-shuiguo","iconfont icon-xihu-kouqianghuli","iconfont icon-canchu-daojianzhenban","iconfont icon-canchu-guoju","iconfont icon-dianqi-diannao",
                                "iconfont icon-yundonghuwai-yundong","iconfont icon-jiaju-qingjie","iconfont icon-nanshi-txu","iconfont icon-nvshi-kuzhuang","iconfont icon-nvshi-weiyi",
                                "iconfont icon-xihu-hufu","iconfont icon-muyin-yinyouerzhuang","iconfont icon-dianqi-shuma","iconfont icon-muyin-zhiniaoku","iconfont icon-muyin-xihu","iconfont icon-muyin-tongzhuang",
                                "iconfont icon-nanshi-zhenzhishan","iconfont icon-jiaju-dengshi","iconfont icon-yinshi-shicai","iconfont icon-dianqi-gehujiankang",
                                "iconfont icon-dianqi-shouji","iconfont icon-muyin-wanju","iconfont icon-xihu-meizhuang","iconfont icon-jiaju-shouna","iconfont icon-yundonghuwai-huwai","iconfont icon-xihu-shengliyongpin",
                                "iconfont icon-canchu-beihu","iconfont icon-nvshi-nvbao","iconfont icon-jiaju-weiyu","iconfont icon-nvshi-chenshan","iconfont icon-jiaju-jiaju","iconfont icon-jiaju-shipin",
                                "iconfont icon-muyin-weiyang","iconfont icon-nanshi-chenshan","iconfont icon-nanshi-kuzhuang","iconfont icon-jiaju-chuangpinjiantao","iconfont icon-nanshi-wazi","iconfont icon-news1",
                                "iconfont icon-nvshi-nvxie","iconfont icon-bangong-zhuoyi","iconfont icon-bangong-wenju",'iconfont icon-jingji','iconfont icon-quanchangbaoyou'];
                                
         var searchicons    =   ["iconfont icon-muyin-qinju","iconfont icon-nanshi-nanxie","iconfont icon-nvshi-peishi","iconfont icon-dianqi-peijian","iconfont icon-nvshi-jiajufu",
                                "iconfont icon-yinshi-lingshi","iconfont icon-canchu-canju","iconfont icon-yinshi-tiaoweipin","iconfont icon-nvshi-waitao","iconfont icon-canchu-chuju",
                                "iconfont icon-nvshi-lianyiqun","iconfont icon-dianqi-dianshi","iconfont icon-yinshi-baojianpin","iconfont icon-muyin-chechuangyongpin",
                                "iconfont icon-nanshi-neiyi","iconfont icon-nvshi-neiyi","iconfont icon-jiaju-jiazhuangzhucai","iconfont icon-yinshi-chongyin","iconfont icon-nanshi-waitao",
                                "iconfont icon-nanshi-xizhuang","iconfont icon-xihu-xifahufa","iconfont icon-jiaju-jujiabuyi","iconfont icon-muyin-yunchan",
                                "iconfont icon-nanshi-peishi","iconfont icon-nanshi-nanbao","iconfont icon-yinshi-jiulei","iconfont icon-nanshi-jiajufu",
                                "iconfont icon-nanshi-weiyi","iconfont icon-canchu-qingjiebaoxian","iconfont icon-yundonghuwai-jianshen","iconfont icon-yinshi-shengxian","iconfont icon-yinshi-liangyou",
                                "iconfont icon-yinshi-shuiguo","iconfont icon-xihu-kouqianghuli","iconfont icon-canchu-daojianzhenban","iconfont icon-canchu-guoju","iconfont icon-dianqi-diannao",
                                "iconfont icon-yundonghuwai-yundong","iconfont icon-jiaju-qingjie","iconfont icon-nanshi-txu","iconfont icon-nvshi-kuzhuang","iconfont icon-nvshi-weiyi",
                                "iconfont icon-xihu-hufu","iconfont icon-muyin-yinyouerzhuang","iconfont icon-dianqi-shuma","iconfont icon-muyin-zhiniaoku","iconfont icon-muyin-xihu","iconfont icon-muyin-tongzhuang",
                                "iconfont icon-nanshi-zhenzhishan","iconfont icon-jiaju-dengshi","iconfont icon-yinshi-shicai","iconfont icon-dianqi-gehujiankang",
                                "iconfont icon-dianqi-shouji","iconfont icon-muyin-wanju","iconfont icon-xihu-meizhuang","iconfont icon-jiaju-shouna","iconfont icon-yundonghuwai-huwai","iconfont icon-xihu-shengliyongpin",
                                "iconfont icon-canchu-beihu","iconfont icon-nvshi-nvbao","iconfont icon-jiaju-weiyu","iconfont icon-nvshi-chenshan","iconfont icon-jiaju-jiaju","iconfont icon-jiaju-shipin",
                                "iconfont icon-muyin-weiyang","iconfont icon-nanshi-chenshan","iconfont icon-nanshi-kuzhuang","iconfont icon-jiaju-chuangpinjiantao","iconfont icon-nanshi-wazi","iconfont icon-news1",
                                "iconfont icon-nvshi-nvxie","iconfont icon-bangong-zhuoyi","iconfont icon-bangong-wenju",'iconfont icon-jingji','iconfont icon-quanchangbaoyou'];

$('#category-icon').fontIconPicker({
        source: icons,
        theme:'fip-bootstrap',
		emptyIconValue: 'none'});

EOT;

        $this->prepend('<i class="fa fa-pencil"></i>')
            ->defaultAttribute('style', 'width: 140px');

        return parent::render();
    }
}