@extends('mobile.default.layouts.layout')
@section('content')
    <div class="user-history-title">
        浏览历史
    </div>
    @component('mobile.default.component.goods_list_v',['list'=>$list->items()])
    @endcomponent
@endsection
@section('script')
    <script>
        var nextPageUrl                    =   '{{$list->nextPageUrl()}}';
        $(window).scroll(function () {
            var scrollTop = $(this).scrollTop();
            var scrollHeight = $(document).height();
            var windowHeight = $(this).height();
            if (scrollTop + windowHeight == scrollHeight) {
                if(nextPageUrl!=''){
                    nextPage(nextPageUrl,'#goods-list-result');
                }
            }
        });
        $('.footer').parent().hide();

    </script>
@endsection