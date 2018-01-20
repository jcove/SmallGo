@extends('layouts.app')
@section('content')

                <div class="goods-detail">
                    <div class="goods-header row">
                        <div class="goods-picture col-md-5">
                            <div class="play">
                                <div class="big_pic">
                                    @if(count($goods->pictures) > 0)
                                        @foreach($goods->pictures as $picture)
                                            @if ($loop->first)
                                                <img src="{{get_image_url($picture)}}"/>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="small_pic">
                                    <ul>
                                        @if(count($goods->pictures) > 0)
                                            @foreach($goods->pictures as $picture)
                                                @if ($loop->first)
                                                    <li>
                                                        <img src="{{get_image_url($picture)}}"/>
                                                    </li>
                                                @else
                                                    @if($loop->index <5)
                                                        <li>
                                                            <img src="{{get_image_url($picture)}}"/>
                                                        </li>
                                                    @endif

                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="goods-info-box col-md-7">
                            <div class="goods-info">
                                <h1 class="goods-title">{{ $goods->name }}</h1>
                                <div class="goods-price-box">
                                    <div class="price">￥<span class="goods-price">{{ $goods->price }}</span></div>
                                    @if($goods->coupon_status > 0)
                                        <div class="coupon coupon-fee">
                                            {{$goods->coupon_amount}}元券
                                        </div>
                                    @endif
                                </div>
                                <div class="volume">
                                    月销{{$goods->volume}}
                                </div>
                                <div class="buy">
                                    @if($goods->coupon_status > 0)
                                        <div class="go-buy">
                                            <a class="btn btn-l btn-danger" href="{{ $goods->coupon_click_url }}">领券购买</a>
                                        </div>

                                    @endif
                                    <div class="go-buy">
                                        <a class="btn btn-l btn-danger" href="{{ $goods->click_url ? $goods->click_url : url('/go',['num_iid'=>$goods->original_id])}}">去购买</a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="goods-body clear row">
                        <div class="recommend-box">
                            @include('widgets.recommend_goods')
                        </div>
                        <div class="goods-detail">
                            <div class="goods-body-title">
                                商品详情
                            </div>
                            <div class="content">
                                @if(empty($goods->detail))
                                    <p class="loadding-lab text-center">加载中，请稍后……</p>
                                @else
                                    {!! $goods->detail  !!}
                                @endif
                            </div>
                        </div>
                    </div>

                </div>


@endsection
@section('script')
    <script>
        if($('.content').find('.loadding-lab').length> 0){
            setTimeout(function () {
                $.ajax({
                    type: "get",
                    async: false,
                    url: 'http://hws.m.taobao.com/cache/mtop.wdetail.getItemDescx/4.1/?&data={"item_num_id":"' + '{{$goods->original_id}}' + '"}&type=jsonp',
                    dataType: "jsonp",
                    jsonp: "callback",
                    jsonpCallback: "showTuwen",
                    success: function (jsonp) {
                        $('.loadding-lab').fadeOut(300);
                        if (jsonp.data.images.length > 0) {
                            for (var i = 0; i < jsonp.data.images.length; i++) {
                                $('.content').append('<p><img src="' + jsonp.data.images[i] + '"/></p>');
                            }
                        }

                        isLoad = true;
                    },
                    error: function () {
                    }
                });
            }, 1000);
        }

    </script>
@endsection