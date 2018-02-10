@extends('mobile.layouts.layout')
@section('content')

    @component('mobile.component.sort_bar',['url'=>'channel/'.$id,'desc'=>$desc,'sort'=>$sort])
    @endcomponent
    @if(count($list) > 0)
            <div class="box">
                @component('mobile.component.goods_list_h',['list'=>$list,''])
                @endcomponent
            </div>
    @else
        @include('mobile.component.empty')
    @endif

@endsection
@section('script')
    <script>
        $(function () {
            nextPageUrl                     =   '{{url()->current()}}';
            $('a[href="'+nextPageUrl+'"]').closest('li').addClass('active');
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
