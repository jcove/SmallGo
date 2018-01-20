@extends('mobile.layouts.layout')
@section('content')
    @component('mobile.component.search_bar')
        @slot('url')
            {{url('search/goods')}}
        @endslot
    @endcomponent
    <div class="goods-list-h">
        @component('mobile.component.sort_bar',['url'=>'search/goods/'.$keywords,'desc'=>$desc,'sort'=>$sort])
        @endcomponent
        @if(count($list) > 0)
        <ul id="result" class="list">
            @foreach($list as $item)
                @component('mobile.component.goods_list_item_h',['url'=>'/item','item'=>$item])
                @endcomponent
            @endforeach
        </ul>
        @else
            @include('mobile.component.empty')
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