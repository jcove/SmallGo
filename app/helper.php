<?php
/**
 * User: XiaoFei Zhai
 * Date: 17/10/17
 * Time: 下午4:16
 */

function get_image_url($path){
    if (URL::isValidUrl($path)) {
        return $path;
    }
    return Storage::disk(config('admin.upload.disk'))->url($path);
}
function is_mobile()
{
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])) {
        return TRUE;
    }
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA'])) {
        return stristr($_SERVER['HTTP_VIA'], "wap") ? TRUE : FALSE;// 找不到为flase,否则为TRUE
    }
    // 判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array(
            'mobile',
            'nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap'
        );
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return TRUE;
        }
    }
    if (isset ($_SERVER['HTTP_ACCEPT'])) { // 协议法，因为有可能不准确，放到最后判断
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== FALSE) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === FALSE || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return TRUE;
        }
    }
    return FALSE;
}
function smallgo_ad($position){
    $ad                                 =   \App\Models\Ad::getByPosition($position);
    if($ad){
        return smallgo_view('widget_ad.'.$position,['ad'=>$ad]);
    }
    return '';
}
function smallgo_view($view='',$data=[]){
    if(request()->ajax() && !empty($view)){
        $view                       =   $view.'_ajax';
    }

    if(request()->acceptsHtml()){
        if(is_mobile()){
            return view('mobile.'.config('site.template_mobile').'.'.$view,$data);
        }else{
            return view('pc.'.config('site.template_pc').'.'.$view,$data);
        }
    }
    if(request()->acceptsJson()){
        return response()->json($data);
    }

}
if (!function_exists('pub_asset')) {

    /**
     * @param $path
     *
     * @return string
     */
    function pub_asset($path)
    {
        return asset($path, config('site.secure'));
    }
}