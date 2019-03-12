@extends('mobile.default.layouts.layout')
@section('content')
    @component('mobile.default.component.search_bar',['url'=>url('search/goods'),'keywords'=>$keywords])
    @endcomponent
    <div class="goods-list-h">
        @component('mobile.default.component.sort_bar',['route'=>'search.goods','params'=>['keywords'=>$keywords],'desc'=>$desc,'sort'=>$sort])
        @endcomponent
        @if(count($list) > 0)
        <ul id="result" class="list">
            @foreach($list as $item)
                @component('mobile.default.component.goods_list_item_h',['route'=>'goods.item','item'=>$item])
                @endcomponent
            @endforeach
        </ul>
        @else
            @include('mobile.default.component.empty')
        @endif
    </div>
@endsection
@section('script')
    <script>
        nextPageUrl                     =   '{{url()->current()}}';
        let page = 2;
        $(window).scroll(function () {
            let scrollTop = $(this).scrollTop();
            let scrollHeight = $(document).height();
            let windowHeight = $(this).height();
            if (scrollTop + windowHeight === scrollHeight) {
                nextPage(nextPageUrl+'?page='+page,'#result');
                page++;
            }
        });
    </script>
@endsection