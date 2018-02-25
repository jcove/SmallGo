@extends('mobile.layouts.layout')
@section('content')
    @component('mobile.component.search_bar')
        @slot('url')
            {{url('search/coupon')}}
        @endslot
    @endcomponent

    @component('mobile.component.sort_bar',['url'=>'category/'.$id.'/'.$sub_id,'desc'=>$desc,'sort'=>$sort])
    @endcomponent
    @if(count($list) > 0)
            <div class="box">
                @component('mobile.component.goods_list_h',['list'=>$list,'url'=>'/item'])
                @endcomponent
            </div>
    @else
            @include('mobile.component.empty')
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
