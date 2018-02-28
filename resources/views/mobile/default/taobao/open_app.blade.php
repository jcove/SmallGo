<!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1, minimum-scale=1, user-scalable=no">
    <title>领取优惠券并购买</title>
    <script src="{{asset('js/taobao.js')}}"></script>
    <style>
        .wakeup{ margin: 8% auto; font-family: "Arial","Microsoft YaHei"; text-align: center; }
        .wakeup img{ max-width: 150px; }
        .wakeup p{ color: #888; }
        .wakeup a{ border: #487ef1 solid 1px; border-radius: 5px; color: #487ef1; padding: 3% 10%; max-width: 300px; line-height: 25px; text-decoration: none; display: inline-block; }
        iframe{ display:none;border:0;width:0;height:0; }
    </style>
    <style>#BAIDU_DSPUI_FLOWBAR,.adsbygoogle,.ad,div[class^="ad-widsget"],div[id^="div-gpt-ad-"],a[href*="cpro.baidu.com"],a[href*="@"][href*=".exe"],a[href*="/?/"][href*=".exe"],.adpushwin{display:none!important;max-width:0!important;max-height:0!important;overflow:hidden!important;}</style></head>

<body>

<h4 class="wakeup"><img src="{{asset('images/tao.png')}}"></h4>

<h4 class="wakeup"><p>正在打开手机淘宝...</p></h4>

<h4 class="wakeup"><a href="{{$url}}">直接访问</a></h4>

<script>

//    function openApp(url) {
//
//        var ua = navigator.userAgent.toLowerCase();
//        var tb = url.replace("http://", "").replace("https://", "");
//
//        if( ua.match(/iphone/i) == "iphone" || true ) {
//
//            window.location = "taobao://" + tb;
//            window.setTimeout(function() {window.location = url;},4000);
//
//        }else{
//
//            var ifr = document.createElement('iframe');
//            ifr.src = 'taobao://' + tb;
//            ifr.style.display = 'none';
//            document.body.appendChild(ifr);
//
//            window.location = url;
//
//        }
//
//    }

    //只在有优惠券的时候执行
  //  openApp('{{$url}}');
    setTimeout(function () {
        window.wakeup && window.wakeup( '{{$url}}' );
    },1000);


</script>
</body>
</html>