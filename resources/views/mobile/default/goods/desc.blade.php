<html>
<head>
    <meta charset="utf-8" />
    <title>图文详情</title>
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="spm-id" content="a2141" />
    <script type="text/javascript">
        window.onerror = function(e) {
            console.error(e);
        }

        window['detailLoadTime'] = Date.now();
        (function() {
            var params = location.search.slice(1).split('&');
            var hashs = location.hash.slice(2).split('&');
            params = params.concat(hashs);
            var tmParam = {};
            var tmKey;
            for (var i = 0, len = params.length; i < len; i++) {
                tmKey = params[i].split('=');
                tmParam[tmKey[0]] = tmKey[1];
            }
            var descType = tmParam.type || 0;
            var userId = tmParam.buyerId;
            userId = userId ? String(userId) : null;
            if (descType && descType == 1) {
                document.write('<meta name="viewport" content="width=750,maximum-scale=1,user-scalable=yes" />');
            }
            else {
                dpr = 1;
                document.write('<meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport" />')
            }
        })();
    </script>
    <style>
        #J_des div{
            overflow: hidden;
        }
        img{
            max-width: 100%;
        }
        br{
            display: none;
        }
    </style>
</head>
<body data-spm="7690265">
<script type="text/javascript" id="aplus-sufei" src="//g.alicdn.com/secdev/sufei_data/3.4.1/index.js" async defer></script>
<script type="text/javascript" src="//g.alicdn.com/alilog/??s/7.5.8/plugin/aplus_windvane2.js,s/7.6.8/plugin/aplus_client.js,aplus_cplugin/0.1.2/monitor.js,s/7.6.8/aplus_wap.js,aplus_cplugin/0.1.2/aol.js,s/7.6.8/plugin/aplus_spmact.js" async defer></script>
<script src="{{mix('taobao/js/zepto.1.0.4.js')}}"></script>
<script src="{{mix('taobao/js/combo.js')}}"></script>
<script src="{{mix('taobao/js/detail_new.js')}}"></script>
</body>
</html>