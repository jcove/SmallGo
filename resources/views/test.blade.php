<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if(isset($title)) {{$title}}-{{config('app.name', 'SmallGo')}} @else {{config('app.name', 'SmallGo')}}@endif</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <link href="{{ mix('iconfont/iconfont.css')}}"  rel="stylesheet" >
    @yield('style')
    <script src="http://apps.bdimg.com/libs/jquery/1.9.0/jquery.min.js"></script>
</head>
<body>
    <div>
        <a data-type="0" biz-itemid="534326029560" data-tmpl="470x190" data-tmplid="635" data-rd="2" data-style="2" data-border="1" href="http://item.taobao.com/item.htm?id=534326029560">http://item.taobao.com/item.htm?id=534326029560</a>
    </div>

<script src="{{ mix('js/app.js') }}"></script>
    <script type="text/javascript">
        (function(win,doc){
            var s = doc.createElement("script"), h = doc.getElementsByTagName("head")[0];
            if (!win.alimamatk_show) {
                s.charset = "gbk";
                s.async = true;
                s.src = "https://alimama.alicdn.com/tkapi.js";
                h.insertBefore(s, h.firstChild);
            };
            var o = {
                pid: "mm_32640998_6774965_35030456",/*推广单元ID，用于区分不同的推广渠道*/
                appkey: "",/*通过TOP平台申请的appkey，设置后引导成交会关联appkey*/
                unid: "",/*自定义统计字段*/
                type: "click" /* click 组件的入口标志 （使用click组件必设）*/
            };
            win.alimamatk_onload = win.alimamatk_onload || [];
            win.alimamatk_onload.push(o);
        })(window,document);
    </script>
</body>
</html>