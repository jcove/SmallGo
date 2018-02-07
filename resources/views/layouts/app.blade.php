<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if(isset($title)) {{$title}}-{{config('app.name', 'SmallGo')}} @else {{config('app.name', 'SmallGo')}}@endif Powered by SmallGo</title>
    <meta name="keywords" content="@yield('keywords', config('app.keywords'))"/>
    <meta name="description" content="@yield('description', config('app.description'))"/>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <link href="{{ mix('iconfont/iconfont.css')}}"  rel="stylesheet" >
    @yield('style')
    <script src="http://apps.bdimg.com/libs/jquery/1.9.0/jquery.min.js"></script>

</head>
<body>
    @include('component.header')
    @include('component.content')
    @include('component.footer')
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
            hm.src = "https://hm.baidu.com/hm.js?a5690d79cb1ea6ab51f9c19f8aa32924";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    @yield('script')
</body>
</html>
