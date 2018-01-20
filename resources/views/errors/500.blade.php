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
    <link href="{{ mix('css/eui.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('iconfont/iconfont.css')}}"  rel="stylesheet" >
</head>
<body>
<div>
    <img style="max-width: 100%;display: block;margin-top: 30%;margin-left: auto;margin-right: auto" src="{{asset('images/404.png')}}">
    <p style="font-size: 14px;text-align: center;color: #a3a3a3">小二很忙,系统很累,页面不见了</p>
    <br>
    <a href="/" style="color:#1ab7ea;font-size: 14px;text-align: center;display: block">首页</a>
</div>
</body>
</html>
