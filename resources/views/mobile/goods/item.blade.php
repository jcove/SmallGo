@extends('mobile.layouts.layout')
@section('style')
    <link rel="stylesheet" href="{{asset("css/wapshow.css")}}" type="text/css"/>
@endsection
@section('content')
    <style>
        .footer {
            display: none;
        }
    </style>
    @if(isset($goods))
        <div class="detail-img">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @if(count($goods->pictures) > 0)
                        @foreach($goods->pictures as $picture)
                            <div class="swiper-slide">
                                <img src="{{get_image_url($picture)}}"/>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="swiper-pagination swiper-pagination-white"></div>
            </div>
        </div>
        <div class="detail-info">
            <p class="name goods-title">{{$goods->name}}</p>

            @if($goods->coupon_status >0)
                <div class="goods-original-box">
                    <p class="original-price">
                        <span class="price"> {{!empty($item->from_site) ?$item->from_site:'淘宝'}}
                            价 ￥{{$goods->price}}</span>
                        <span class="volume">月销{{$goods->volume or 0}}</span></p>
                </div>
                <div class="goods-price-box">
                    <p class="goods-price">
                        <span class="tips">券后</span>
                        <span class="price">￥{{$goods->coupon_price}}</span>
                        <span class="coupon-fee" style="float: right">{{$goods->coupon_amount}} 元券</span>
                    </p>
                </div>
            @else
                <div class="goods-price-box">
                    <p class="goods-price">
                        <span class="price"><span class="site-price">{{!empty($item->from_site) ?$item->from_site:'淘宝'}}
                                价</span> ￥{{$goods->coupon_price}}</span>
                        <span class="volume">月销{{$goods->volume or 0}}</span>
                    </p>
                </div>
            @endif


        </div>
        <div class="tuwen-tkl">
            <div class="beatWord">
                <fieldset>
                    <legend>长按框内&gt;全选&gt;复制&gt;打开手淘</legend>
                    <p class="itemWord" rows="1">{{$goods->tpwd}}</p>
                </fieldset>
                <button type="button" data-clipboard-text="{{$goods->tpwd}}" data-clipboard-done="复制成功" class="itemCopy">
                    复制口令
                </button>
                <button type="button" data-clipboard-done="浏览器打开" class="itemCopy" data-clipboard-code="{{$code}}">
                    复制链接
                </button>
                <button type="button" class="itemOpen">立即领券</button>
            </div>
            <div class="pic-detail">
                <div class="pic-detail-btn" data-goodsid="{{$goods->original_id}}">
                    <span class="pic-detail-btn-span">查看图文详情<i></i></span>
                </div>
                <div class="pic-detail-show"></div>
                <span class="loadding-lab">加载中，请稍后……</span>
            </div>

        </div>

        @include('mobile.goods.go_buy')
        <div id="copy_dom" class="copy_dom" style="display: none">{{$goods->tpwd}}</div>
    @else
        @include('mobile.component.empty')
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
                    ifr.src = '{{url('taobao/app')}}?url=' + encodeURIComponent(url);
                    ifr.style.display = 'none';
                    document.body.appendChild(ifr);
                }
            } else {
                window.location.href = url;
            }
        }


        var head = document.querySelector('.beatHeader');
        var beat = document.querySelector('.beatWord');
        var tips = document.querySelector('.itemTips');
        var word = document.querySelector('.itemWord');
        var copy = document.querySelector('.itemCopy');
        var open = document.querySelector('.itemOpen');
        var text = '{{$goods->tpwd}}';

        if (text && text != 'null') {

            tips.innerHTML = '';

            head.className = 'beatHeader';

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
            });

        } else {

            //隐藏复制按钮
            copy.style.display = 'none';

        }

        //////////////////////

        if (mobileUtil.isIOS) {
            var v = (navigator.userAgent).match(/OS (\d+)/i)[1];
            if (v < 10) {
                open.style.display = 'none';
            }
        }


        var url = '{{$goods->click_url}}';

        open.onclick = function () {
            doLnkJump(url);
        }

        //////////////////////

        var btn = document.querySelectorAll('[data-clipboard-code]');

        for (var i = 0; i < btn.length; i++) {
            btn[i].setAttribute('data-clipboard-text', url);
        }


        var isLoad = false;
        var goodsId = $('.pic-detail-btn').data('goodsid');
        $('.pic-detail-btn span.pic-detail-btn-span').click(function () {
            if ($('.pic-detail-show').css('display') == 'none') {
                if (!$(this).hasClass('cur')) {
                    $(this).addClass('cur');
                }
                $('.pic-detail-show').css('display', 'block');
            } else {
                $(this).removeClass('cur');
                $('.pic-detail-show').css('display', 'none');
            }

            if (!isLoad) {
                $('span.loadding-lab').fadeIn(300);
                $(window).scrollTop($(window).scrollTop()+20);
                setTimeout(function () {
                    $.ajax({
                        type: "get",
                        async: false,
                        url: 'http://hws.m.taobao.com/cache/mtop.wdetail.getItemDescx/4.1/?&data={"item_num_id":"' + goodsId + '"}&type=jsonp',
                        dataType: "jsonp",
                        jsonp: "callback",
                        jsonpCallback: "showTuwen",
                        success: function (jsonp) {

                            $('span.loadding-lab').fadeOut(300);
                            if (jsonp.data.images.length > 0) {
                                for (var i = 0; i < jsonp.data.images.length; i++) {
                                    $('.pic-detail-show').append('<p><img src="' + jsonp.data.images[i] + '"/></p>');
                                }
                            }

                            isLoad = true;
                        },
                        error: function () {
                        }
                    });
                }, 300);
            }

        });


        var is_weixin = function () {
            var ua = navigator.userAgent.toLowerCase();
            if (ua.match(/MicroMessenger/i) == "micromessenger") {
                return true;
            } else {
                return false;
            }
        };


        $('.collect').on('click', function () {
            var url = "{{url('collect',['id'=>$goods->id])}}";
            $.get(url, {}, function (response) {
                if (response.status == 1) {
                    toastr.options = {
                        closeButton: false,
                        debug: false,
                        progressBar: true,
                        positionClass: "toast-top-center",
                        onclick: null,
                        showDuration: "300",
                        hideDuration: "1000",
                        timeOut: "2000",
                        extendedTimeOut: "1000",
                        showEasing: "swing",
                        hideEasing: "linear",
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut"
                    };
                    toastr.success(response.message);
                }
            }, 'json')
        });
        @endif

    </script>
@endsection