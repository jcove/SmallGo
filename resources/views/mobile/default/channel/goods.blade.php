@extends('mobile.default.layouts.layout')
@section('content')

    @component('mobile.default.component.sort_bar',['route'=>'channel.show','params'=>['id'=>$id,'title'=>$channel->seo_title],'desc'=>$desc,'sort'=>$sort])
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
            nextPageUrl                     =   '{{url()->current()}}';
            $('a[href="'+nextPageUrl+'"]').closest('li').addClass('active');
            var page                        =   2;
            $(window).scroll(function () {
                var scrollTop = $(this).scrollTop();
                var scrollHeight = $(document).height();
                var windowHeight = $(this).height();
                if (scrollTop + windowHeight === scrollHeight) {
                    nextPage(nextPageUrl+'?page='+page,'#result');
                    page++;
                }
            });
        })

    </script>
@endsection
