@extends('mobile.layouts.layout')
@section('content')

    @if(!empty($keywords))
        @component('mobile.component.search_bar',['url'=>url('search/coupon'),'keywords'=>$keywords])
        @endcomponent
        <div class="goods-list-h">
            @if(count($list) > 0)
                <ul id="result" class="list">
                    @foreach($list as $item)
                        @include('mobile.search.goods_list_item_h')
                    @endforeach
                </ul>
            @else
                @include('mobile.component.empty')
            @endif
        </div>
    @else
        @component('mobile.component.search_bar')
            @slot('url')
                {{url('search/coupon')}}
            @endslot
        @endcomponent
    @endif
@endsection
@section('script')
    <script>
        $('#keywords').keyup(function ($event) {
            if($event.keyCode==13){
                window.location.href=SMALL_GO.APP_URL+'/search/coupon/'+$(this).val();
            }
        });

        nextPageUrl                     =   '{{url()->current()}}';
        var page                        =   2;
        $(window).scroll(function () {
            var scrollTop = $(this).scrollTop();
            var scrollHeight = $(document).height();
            var windowHeight = $(this).height();
            if (scrollTop + windowHeight == scrollHeight) {
                nextPage(nextPageUrl+'?page='+page,'#result');
                page++;
            }
        });
        $('.footer').parent().hide();
    </script>
@endsection