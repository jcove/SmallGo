<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <meta name="keywords" content="@yield('keywords', config('app.keywords')))"/>
    <meta name="description" content="@yield('description', config('app.description'))"/>
    <title>@if(isset($title)) {{$title}}-{{config('app.name', 'SmallGo')}} @else {{config('app.name', 'SmallGo')}}@endif</title>
    <link rel="stylesheet" href="{{mix("css/mobile.css")}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset("vendor/laravel-admin/toastr/build/toastr.min.css")}}" type="text/css"/>
    <link href="//at.alicdn.com/t/font_433157_1j9zqcqasb57b9.css"  rel="stylesheet" >
    @yield('style')
    <script src="{{mix("js/flex.js")}}"></script>
</head>
<body>
<div id="app" class="app">
    @yield('content')
</div>
<div class="bg">

</div>
@include('mobile.component.nav_bar')
<script>
    var SMALL_GO        =   {
        APP_URL:"{{env('APP_URL')}}"
    };
</script>
<script src="{{mix("js/m.js")}}"></script>
<script src="{{asset('vendor/laravel-admin/toastr/build/toastr.min.js')}}"></script>
<script>
    $(function () {
        $('.footer').find('li').removeClass('active');
    })

</script>
    @yield('script')
</body>
</html>