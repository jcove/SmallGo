<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="keywords" content="@yield('keywords', config('app.keywords')))"/>
    <meta name="description" content="@yield('description', config('app.description'))"/>
    <title>@yield('title', config('app.title', 'SmallGo'))</title>
    <link rel="stylesheet" href="{{mix("css/mobile.css")}}" type="text/css"/>
    <link href="{{ mix('iconfont/iconfont.css')}}"  rel="stylesheet" >
</head>
<body>
<div id="app" class="app">
    @yield('app')
</div>
<script src="{{mix("js/mobile.js")}}"></script>
</body>
</html>