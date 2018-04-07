@extends('mobile.default.layouts.layout')
@if(isset($goods))
@section('keywords')
    {{$goods->keywords}}
    @endsection
    @section('description')
        {{$goods->description}}
    @endsection
@endif

@section('content')
    <style>
        .footer {
            display: none;
        }
    </style>
    @if(isset($goods) && $goods->status > 0)
        <div class="detail-img">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @if(!empty($goods->pictures))
                        @foreach($goods->pictures as $picture)
                            <div class="swiper-slide">
                                <img style="display: block" alt="{{$goods->title}}" src="{{get_image_url($picture)}}"/>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="swiper-pagination swiper-pagination-white"></div>
            </div>
            @if($goods->coupon_status)
                <span class="coupon-fee">{{$goods->coupon_amount}} 元券</span>
            @endif
        </div>
        <div class="detail-info">
            <p class="name goods-title">{{$goods->name}}</p>

            <div class="goods-price-box">
                <p class="goods-price">
                    <span class="price"><span class="site-price">{{!empty($item->from_site) ?$item->from_site:'淘宝'}}
                            价</span> ￥{{$goods->coupon_price}}</span>
                    <span class="volume">月销{{$goods->volume or 0}}</span>
                </p>
            </div>
        </div>
        <div class="goods-body">
            <div class="beatWord">
                <fieldset>
                    <legend>长按框内&gt;全选&gt;复制&gt;打开手淘</legend>
                    <p class="itemWord" rows="1">{{$goods->tpwd}}</p>
                    <button type="button" data-clipboard-text="{{$goods->tpwd}}" data-clipboard-done="复制成功"
                            class="itemCopy eui-btn eui-btn-blue">
                        复制口令
                    </button>
                    <button type="button" data-clipboard-done="复制成功" class="itemCopy eui-btn"
                            data-clipboard-code="{{$code}}">
                        复制链接
                    </button>

                </fieldset>

            </div>
            <div class="pic-detail">
                <div class="pic-detail-show"></div>
                <p class="loadding-lab">继续向下滑动，加载详情</p>
            </div>

        </div>
        @include('mobile.default.goods.go_buy')
    @else
        @include('mobile.default.goods.empty')
    @endif

@endsection
@section('script')
    <script src="{{asset('js/clipboard.min.js')}}"></script>
    <script>
        @if(isset($goods))
            window.mobileUtil = (function (win, doc) {
            var UA = navigator.userAgent,
                isAndroid = /android|adr|linux/gi.test(UA),
                isIOS = /iphone|ipod|ipad/gi.test(UA) && !isAndroid,
                isBlackBerry = /BlackBerry/i.test(UA),
                isWindowPhone = /IEMobile/i.test(UA),
                isMobile = isAndroid || isIOS || isBlackBerry || isWindowPhone;
            return {
                isAndroid: isAndroid,
                isIOS: isIOS,
                isMobile: isMobile,
                isWeixin: /MicroMessenger/gi.test(UA),
                isQQ: / QQ/gi.test(UA),
                isPC: !isMobile
            };
        })(window, document);

        function doLnkJump(url) {
            if (mobileUtil.isIOS) {
                url = 'https://t.asc' + 'zwa.com/ta' + 'obao' + '?back' + 'url=' + encodeURIComponent(url);
            }
            if (mobileUtil.isAndroid) {
                if (mobileUtil.isQQ) {
                    var tb_url = url.replace("http://", "").replace("https://", "");
                    var ifr = document.createElement('iframe');
                    ifr.src = 'tao' + 'bao' + '://' + tb_url;
                    ifr.style.display = 'none';
                    document.body.appendChild(ifr);
                    window.location.href = url;
                } else {
                    var ifr = document.createElement('iframe');
                    ifr.src = '{{route('taobao.open.app')}}?url=' + encodeURIComponent(url);
                    ifr.style.display = 'none';
                    document.body.appendChild(ifr);
                }
            } else {
                window.location.href = url;
            }
        }


        var beat = document.querySelector('.beatWord');

        var word = document.querySelector('.itemWord');
        var copy = document.querySelector('.itemCopy');
        var open = $('.itemOpen');
        console.log(open);
        var text = '{{$goods->tpwd}}';
        if (text && text != 'null') {
            //自动选择文本
            document.addEventListener("selectionchange", function (e) {
                window.getSelection().selectAllChildren(word);
            }, false);

            word.value = text;

        } else {
            beat.style.display = 'none';
        }

        //////////////////////

        if (window.Clipboard && Clipboard.isSupported()) {

            //复制文本
            var clipboard = new Clipboard('.itemCopy');

            //复制成功
            clipboard.on('success', function (e) {
                e.trigger.innerHTML = e.trigger.getAttribute('data-clipboard-done');
                e.trigger.style.background = '#33CC99';
            });

        } else {

            //隐藏复制按钮
            copy.style.display = 'none';

        }

        //////////////////////

        // if (mobileUtil.isIOS) {
        //     var v = (navigator.userAgent).match(/OS (\d+)/i)[1];
        //     if (v < 10) {
        //         open.hide();
        //     }
        // }
        var url = '{{$goods->click_url}}';

        open.on('click',function () {
            doLnkJump(url);
        });

        //////////////////////

        var btn = document.querySelectorAll('[data-clipboard-code]');

        for (var i = 0; i < btn.length; i++) {
            btn[i].setAttribute('data-clipboard-text', url);
        }


        var isLoad = false;

        function loadDetail() {
            if ($('.pic-detail-show').css('display') === 'none') {
                $('.pic-detail-show').css('display', 'block');
            }
            if (!isLoad) {
                $('.loadding-lab').text('加载中，请稍后……');
                setTimeout(function () {
                    $.ajax({
                        type: "get",
                        async: false,
                        url: 'http://hws.m.taobao.com/cache/mtop.wdetail.getItemDescx/4.1/?&data={"item_num_id":"{{$goods->original_id}}"}&type=jsonp',
                        dataType: "jsonp",
                        jsonp: "callback",
                        jsonpCallback: "showTuwen",
                        success: function (jsonp) {

                            $('.loadding-lab').fadeOut(300);
                            if (jsonp.data.images.length > 0) {
                                for (var i = 0; i < jsonp.data.images.length; i++) {
                                    $('.pic-detail-show').append('<p><img alt="{{$goods->title}}" src="' + jsonp.data.images[i] + '"/></p>');
                                }
                            }
                            $.get("{{route('taobao.recommend')}}",{'num_iid':'{{$goods->original_id}}'},function (response) {
                                $('.goods-body').after(response);
                                lazyload();
                            });
                            isLoad = true;
                        },
                        error: function () {
                        }
                    });
                }, 300);
            }

        }


        let is_weixin = function () {
            let ua = navigator.userAgent.toLowerCase();
            return ua.match(/MicroMessenger/i) === "micromessenger";
        };
        $(window).scroll(function () {
            var scrollTop = $(this).scrollTop();
            var scrollHeight = $(document).height();
            var windowHeight = $(this).height();
            if (scrollTop + windowHeight === scrollHeight) {
                loadDetail();
            }
        });

        @endif

    </script>
@endsection