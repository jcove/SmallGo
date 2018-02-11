@extends('layouts.app')
@if(isset($goods))
    @section('keywords')
        {{$goods->keywords}}
    @endsection
    @section('description')
        {{$goods->description}}
    @endsection
@endif

@section('content')
    @if(isset($goods) && $goods->status > 0)
        <div class="goods-detail">
            <div class="goods-header row">
                <div class="goods-picture col-md-5">
                    <div class="play">
                        <div class="big_pic">
                            @if(!empty($goods->pictures))
                                @foreach($goods->pictures as $picture)
                                    @if ($loop->first)
                                        <img alt="{{$goods->title}}" src="{{get_image_url($picture)}}"/>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <div class="small_pic">
                            <ul>
                                @if(!empty($goods->pictures))
                                    @foreach($goods->pictures as $picture)
                                        @if ($loop->first)
                                            <li>
                                                <img alt="{{$goods->title}}" src="{{get_image_url($picture)}}"/>
                                            </li>
                                        @else
                                            @if($loop->index <5)
                                                <li>
                                                    <img alt="{{$goods->title}}" src="{{get_image_url($picture)}}"/>
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
                        <p class="goods-title">{{ $goods->name }}</p>
                        <div class="goods-price-box">
                            @if($goods->coupon_status > 0)
                                <span class="now-price"><b class="theme-color-8">(独享)</b>券后价&nbsp;&nbsp;&nbsp;&nbsp;<b
                                            class="theme-color-8">¥<span>{{$goods->coupon_price}}</span></b></span>
                                <span class="org-price">在售价&nbsp;&nbsp;¥<span>{{$goods->price}}</span></span>
                            @else
                                <span class="now-price"><b class="theme-color-8">¥<i>{{$goods->price}}</i></b></span>
                            @endif

                        </div>
                        <div class="volume">
                            <span class="text-wrap-span">疯抢中，手慢无！</span>
                            <span>已有<i>{{$goods->volume}}</i>人购买</span>
                        </div>
                        <div class="buy theme-bg-color-8 clearfix">
                            @if($goods->coupon_status > 0)
                                <div class="buy-coupon theme-color-8">
                                    <span>优惠券</span>
                                    <span><b><i>￥</i>{{$goods->coupon_amount}}</b></span>
                                </div>
                                <a rel="nofollow" class="btn " href="{{ $goods->coupon_click_url }}" target="_blank">
                                    领券购买</a>
                            @else
                                <div class="buy-coupon theme-color-8">
                                    <i class="iconfont icon-zhekou" style="font-size: 22px"></i>
                                </div>
                                <a rel="nofollow" class="btn "
                                   href="{{ $goods->click_url ? $goods->click_url : url('/go',['num_iid'=>$goods->original_id])}}"
                                   target="_blank"> 去抢购</a>
                            @endif

                        </div>
                        <div class="text2">
                            <span>如果您喜欢此宝贝，记得分享给您的朋友，一起享优惠：</span>
                            <div class="bdshare">
                                <div class="bdsharebuttonbox bdshare-button-style0-16" data-bd-bind="1517386003776">
                                    <a href="#" class="bds_more" data-cmd="more"></a>
                                    <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                                    <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                                    <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                                </div>
                                <script>
                                    window._bd_share_config = {
                                        "common": {
                                            "bdSnsKey": {},
                                            "bdText": "最近发现了一个领独享优惠券的网站，都是限时限量抢购，一般人享受不到的！性价比超高哦，分享给大家，保证你会惊喜滴！",
                                            "bdMini": "2",
                                            "bdMiniList": false,
                                            "bdPic": "",
                                            "bdStyle": "0",
                                            "bdSize": "16"
                                        }, "share": {}
                                    };
                                    with (document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
                                </script>
                            </div>
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
    @else
        @include('mobile.goods.empty')
    @endif


@endsection
@section('script')



    @if(!empty($goods) && $goods->status > 0)
        <script>
            if ($('.content').find('.loadding-lab').length > 0) {
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
                                    $('.content').append('<p><img alt="{{$goods->title}}" src="' + jsonp.data.images[i] + '"/></p>');
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

    @endif

@endsection