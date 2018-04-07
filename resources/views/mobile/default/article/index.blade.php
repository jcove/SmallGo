@extends('mobile.default.layouts.layout')
@section('content')
    <div class="article-list">

    </div>
    @foreach($list as $item)
        <li class="">
            <a href="{{route('article.show',['article'=>$item->id])}}" title="{{$item->title}}">
                <div class="item">
                    <!-- 文章图片-->
                    <div class="cover">
                        <img src="{{$item->cover}}" alt="{{$item->title}}">
                    </div>
                    <div class="info">
                        <!-- 文章标题-->
                        <div class="title">{{$item->title}}</div>
                        <div class="other">
                            <div class="pull-right">
                                <!-- 评论信息-->
                                <span class="icon-group">
                                            <i class="zm-icon-comments-o"></i>6                                        </span>
                                <!-- 收藏信息-->
                                <span class="icon-group">
                                            <i class="zm-icon-star-o"></i>20                                        </span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </li>
    @endforeach
@endsection