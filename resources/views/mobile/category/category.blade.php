@extends('mobile.layouts.layout')
@section('content')
    @component('mobile.component.search_bar')
        @slot('url')
            {{url('search/goods')}}
        @endslot
    @endcomponent
    <div class="banner">
        <img src="{{ asset('home/images/loading.gif') }}" data-src="{{$cover->cover}}" alt="{{$cover->name}}" class="lazyload sg-img-responsive">
    </div>
    @include('mobile.component.category_bar')

    <div class="goods-list-h">
        @component('mobile.component.sort_bar',['url'=>'category/'.$id.'/'.$sub_id,'desc'=>$desc,'sort'=>$sort])
        @endcomponent
        @if(count($list) > 0)
            <ul id="result">
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
        $(function () {
            $('a[href="'+"{{url('category/lists')}}"+'"]').closest('li').addClass('active');

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
