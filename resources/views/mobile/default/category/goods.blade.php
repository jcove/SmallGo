@extends('mobile.default.layouts.layout')
@section('content')

    <div class="goods-list-h">
        @component('mobile.default.component.sort_bar',['url'=>'/category/goods/'.$category_id,'desc'=>$desc,'sort'=>$sort])
        @endcomponent
        @if(count($list) > 0)
            <ul id="result">
                @foreach($list as $item)
                    @component('mobile.default.component.goods_list_item_h',['url'=>'/item','item'=>$item])
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
        $(function () {
            $('a[href="'+"{{url('category/goods',['id'=>$category_id])}}"+'"]').closest('li').addClass('active');

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
        })

    </script>
@endsection
