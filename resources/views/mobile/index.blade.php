@extends('mobile.layouts.layout')
@section('content')
    @component('mobile.component.search_bar')
        @slot('url')
            {{url('search/goods')}}
        @endslot
    @endcomponent
    <section class="swiper-section">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @if(!empty($swipers))
                    @foreach($swipers as $banner)
                        <div class="swiper-slide">
                            <a href="{{$banner->url}}">
                                <img src="{{$banner->cover}}"/>
                            </a>
                        </div>
                    @endforeach
                @endif

            </div>
            <div class="swiper-pagination swiper-pagination-white"></div>
        </div>
    </section>
    <section>
        @include('mobile.component.channel_bar')
    </section>
    <section>
        <div class="goods-list-v">
            @if(count($list) > 0)
                <ul id="result">
                    @foreach($list as $item)
                       @include('mobile.component.goods_list_item_v')
                    @endforeach
                </ul>
            @endif
        </div>
    </section>
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