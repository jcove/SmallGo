@extends('mobile.default.layouts.layout')
@section('content')
    @component('mobile.default.component.search_bar')
        @slot('url')
            {{url('search/coupon')}}
        @endslot
    @endcomponent

    @component('mobile.default.component.sort_bar',['route'=>'category.show','params'=>['id'=>$category_info->id,'title'=>$category_info->seo_title,'sub_id'=>0],'desc'=>$desc,'sort'=>$sort])
    @endcomponent
    @if(count($list) > 0)
            <div class="box">
                @component('mobile.default.component.goods_list_h',['list'=>$list,'route'=>'goods.item'])
                @endcomponent
            </div>
    @else
            @include('mobile.default.component.empty')
    @endif

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
