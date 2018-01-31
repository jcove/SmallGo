@section('style')
    <style type="text/css">
        .swiper-container {
            width: 950px;
        }
    </style>
@endsection


<div class="swiper-container pull-left">
    <div class="swiper-wrapper">
        @if(count($swipers) > 0)
            @foreach($swipers as $swiper)
                <div class="swiper-slide">
                    <a href="{{$swiper->url}}" target="_blank">
                        <img src="{{ $swiper->cover }}">
                    </a>
                </div>
            @endforeach
        @endif
    </div>
    <!-- 如果需要分页器 -->
    <div class="swiper-pagination"></div>
</div>
