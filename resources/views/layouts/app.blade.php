<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if(isset($title)) {{$title}}-{{config('app.name', 'SmallGo')}} @else {{config('app.name', 'SmallGo')}}@endif Powered by SmallGo</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <link href="{{ mix('iconfont/iconfont.css')}}"  rel="stylesheet" >
    @yield('style')
    <script src="http://apps.bdimg.com/libs/jquery/1.9.0/jquery.min.js"></script>
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
</head>
<body>
    @include('component.header')
    @include('component.content')
    @include('component.footer')
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('script')
</body>
</html>
