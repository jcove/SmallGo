@extends('mobile.default.layouts.layout')
@section('content')
    <div class="user-profile">
        <div class="header">
            <div class="tools">
                <i id="setting" class="iconfont icon-search" style="float: left;color: white;margin: 1.0rem"></i>
                <i id="notice" class="iconfont icon-search" style="float: right;color: white;margin: 1.0rem"></i>
            </div>
            <div class="avatar">
                <img src="{{$user->avatar}}">
            </div>
            <div class="nick">
                {{$user->nick}}
            </div>
            <div class="position">
                {{$user->position}}
            </div>
            <div class="follow">
                <div class="left">
                    <p>关注</p>
                    <span>110</span>
                </div>
                <div class="right">
                    <p>关注</p>
                    <span>110</span>
                </div>
            </div>
        </div>
        <div class="body">
            <ul class="user-menu">
                <li class="menu-item">
                    <a href="{{url('user/collections')}}">
                        <div class="icon">
                            <i class="iconfont icon-search"></i>
                        </div>
                        <div class="link">
                          收藏
                            <span class="r">23&nbsp;&nbsp;&nbsp;&nbsp;<i class="iconfont icon-dayuhao"></i></span>
                        </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{url('user/history')}}">
                        <div class="icon">
                            <i class="iconfont icon-search"></i>
                        </div>
                        <div class="link">
                            流览足迹
                            <span class="r">23&nbsp;&nbsp;&nbsp;&nbsp;<i class="iconfont icon-dayuhao"></i></span>
                        </div>
                    </a>
                </li>
                <li class="menu-item">
                    <div class="icon">
                        <i class="iconfont icon-search"></i>
                    </div>
                    <div class="link">
                        <a href="{{url('history')}}">关于我们</a>
                        <span class="r">&nbsp;&nbsp;&nbsp;&nbsp;<i class="iconfont icon-dayuhao"></i></span>
                    </div>
                </li>
            </ul>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $('.footer').parent().hide();
    </script>
@endsection