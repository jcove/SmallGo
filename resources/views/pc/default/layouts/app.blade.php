<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if(isset($title)) {{$title}}-{{config('site.site_title', 'SmallGo')}} @else {{config('site.site_title', 'SmallGo')}}@endif Powered by SmallGo</title>
    <meta name="keywords" content="@yield('keywords', config('site.site_keywords'))"/>
    <meta name="description" content="@yield('description', config('site.site_description'))"/>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('style')
    @if(config('site.secure'))
        <script src="https://apps.bdimg.com/libs/jquery/1.9.0/jquery.min.js"></script>
    @else
        <script src="http://apps.bdimg.com/libs/jquery/1.9.0/jquery.min.js"></script>
    @endif
</head>
<body>
    @include('pc.default.component.header')
    @include('pc.default.component.content')
    @include('pc.default.component.footer')
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        (function(){
            var bp = document.createElement('script');
            var curProtocol = window.location.protocol.split(':')[0];
            if (curProtocol === 'https'){
                bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
            }
            else{
                bp.src = 'http://push.zhanzhang.baidu.com/push.js';
            }
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(bp, s);
        })();
    </script>
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?{{config('site.baidu_tongji_id')}}";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    @yield('script')
</body>
</html>
