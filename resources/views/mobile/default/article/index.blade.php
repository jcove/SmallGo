@extends('mobile.default.layouts.layout')
@section('content')
    <div class="article-list">
        @foreach($list as $item)
            <li class="">
                <a href="{{route('article.show',['article'=>$item->id])}}" title="{{$item->title}}">
                    <div class="item">
                        <!-- 文章图片-->
                        <div class="cover" style="background-image: url('{{ $item->cover }}')">

                        </div>
                        <div class="info">
                            <!-- 文章标题-->
                            <div class="title">{{$item->title}}</div>
                            <div class="other">
                                <div class="">
                                    <span class="pull-right pub-date">{{$item->created_at}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    </div>

@endsection
@section('script')
    <script>
        $(function () {
            //导航

            $(window).scroll(function () {
                var scrollTop = $(this).scrollTop();
                var scrollHeight = $(document).height();
                var windowHeight = $(this).height();
                if (scrollTop + windowHeight == scrollHeight) {
                    nextPage(nextPageUrl+'?page='+page,'#result');
                    page++;
                }
            });
        });

    </script>
@endsection