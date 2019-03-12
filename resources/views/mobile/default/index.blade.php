@extends('mobile.default.layouts.layout')
@section('content')
    @component('mobile.default.component.search_bar')
        @slot('url')
            {{url('search/goods')}}
        @endslot
    @endcomponent
    <div class="swiper-section">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @if(!empty($swipers))
                    @foreach($swipers as $banner)
                        <div class="swiper-slide">
                            <a href="{{$banner->url}}" title="{{$banner->name}}">
                                <img style="display: block" alt="{{$banner->name}}" src="{{$banner->cover}}"/>
                            </a>
                        </div>
                    @endforeach
                @endif

            </div>
            <div class="swiper-pagination swiper-pagination-white"></div>
        </div>
    </div>

    {{--<div class="box">--}}
        {{--@include('mobile.default.component.channel_bar')--}}
    {{--</div>--}}
    <div class="sg-box">
        {!! smallgo_ad('mobile_index_left') !!}
        {!! smallgo_ad('mobile_index_right_top') !!}
        {!! smallgo_ad('mobile_index_right_bottom') !!}
    </div>
    <div class="box">
        @include('mobile.default.widgets.category_side')
    </div>
    <div class="box">
        @component('mobile.default.component.goods_list_h',['list'=>$list,'title'=>'本站精选','route'=>'goods.item'])
        @endcomponent
    </div>
@endsection
@section('script')
    <script>
        nextPageUrl                     =   '{{url()->current()}}';
        var page                        =   2;
        $(function () {
            //导航
            $('a[href="'+"{{url('')}}"+'"]').closest('li').addClass('active');
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

        var size                =   $('#iscroll').find('li').length;
        $('#iscroll').find('li').width($('#iscroll').width()/3.5);
        var width               =    $('#iscroll').find('li').eq(0).width()*size;
        $('#iscroll').children('ul').eq(0).width(width);

        var myScroll = new IScroll("#iscroll",{
            mouseWheel: true,
            // scrollbars: true,
            scrollX:true,
            click:true
        });
    </script>
@endsection