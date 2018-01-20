(function(scope, wakeup) {
    if (!scope.wakeup) {scope.wakeup = wakeup();}//这一行会在打包时修改成不同版本，修改时请谨慎
})(window, function() {

    function url2obj(url) {
        var re = {},
            unUrl,
            params;

        if (url.length && url.substr(0, 5) !== 'data:') {
            //将query前后分开
            unUrl = url.split('?');

            //无query或?有多个
            if (unUrl.length == 1) {
                unUrl = url.split('#');
                if (unUrl.length >= 2) {
                    unUrl = [unUrl[0], '#' + unUrl.slice(1).join('#')];
                } else {
                    unUrl = [unUrl[0], ''];
                }
            } else if (unUrl.length > 2) {
                unUrl = [unUrl[0], unUrl.slice(1).join('?')];
            }

            //尝试处理protocol
            unUrl[0] = unUrl[0].split('//');
            if (unUrl[0].length !== 2) {
                //与预期不符的统一处理
                unUrl[0] = [undefined, unUrl[0].join('//')];
            }

            if (unUrl[0][0] !== undefined) {
                re.protocol = unUrl[0][0];
            }
            re.path = unUrl[0][1];

            //取query部分
            //先把hash处理掉
            params = unUrl[1].split('#');
            if (params.length >= 2) {
                re.hash = params.slice(-1)[0];
                params = params.slice(0, -1).join('#');
            } else {
                params = params[0];
            }

            //将query分成键值对
            if (params) {
                re.params = {};
                params = params.split('&');
                for (var i = 0, maxi = params.length; i < maxi; i++) {
                    params[i] = params[i].split('=');
                    if (params[i][1] !== undefined) {
                        params[i][1] = params[i].slice(1).join('=');
                        try {
                            params[i][1] = decodeURIComponent(params[i][1]);
                        } catch(e) {
                        }
                    }
                    re.params[params[i][0]] = params[i][1];
                }
            }
        }

        return re;
    }

    function obj2url(obj) {
        var re = [],
            query = [],
            query_added = false;

        if (obj.protocol !== undefined) {
            re.push(obj.protocol + '//');
        }
        if (obj.path !== undefined) {
            obj.path && re.push(obj.path);
        }

        if (obj.params !== undefined) {
            for (var key in obj.params) {
                if (!query_added) {
                    re.push('?');
                    query_added = true;
                }
                if (obj.params.hasOwnProperty(key)) {
                    if (obj.params[key] !== undefined) {
                        query.push([key, '=', encodeURIComponent(obj.params[key])].join(''));
                    } else {
                        query.push(key);
                    }
                }
            }
            re.push(query.join('&'));
        }

        obj.hash && re.push('#' + obj.hash);

        return re.join('');
    }

    function alreadyTbopen(target) {
        return target && target.params && target.params.h5Url !== undefined && /tbopen/i.test(target.path);
    }

    function appendParams(target, toAdd, notPass) {
        var points = ['ali_trackid', 'refpid', 'pid'],
            currentUrl = url2obj(location.href),
            params = {},
            addParamsToH5Url = false,
            theUrl;

        if (target.params === undefined) {
            target.params = {};
        }

        if (alreadyTbopen(target)) {
            addParamsToH5Url = true;
        }

        if (addParamsToH5Url) {
            //将参数透传给h5Url
            theUrl = target.params.h5Url;
            theUrl = url2obj(theUrl);
            if (theUrl.params === undefined) {
                theUrl.params = {};
            }
        } else {
            theUrl = target;
        }

        //添加point参数
        params.from = 'h5';

        if (currentUrl.params && (notPass !== false)) {
            //透传参数
            for (var key in currentUrl.params) {
                if (!theUrl.params.hasOwnProperty(key)) {
                    theUrl.params[key] = currentUrl.params[key];
                }
                if (points.indexOf(key) !== -1) {
                    params[key] = currentUrl.params[key];
                }
            }
        }

        if (toAdd) {
            for (var key in toAdd) {
                theUrl.params[key] = toAdd[key];
            }
        }

        delete currentUrl.params;
        delete currentUrl.hash;
        params.url = obj2url(currentUrl);

        theUrl.params.point = JSON.stringify(params);

        if (addParamsToH5Url) {
            target.params.h5Url = obj2url(theUrl);
        }

        return params.url;
    }

    function useAnchorLink(url, pending) {
        var a = document.createElement('a'),
            e = new MouseEvent('click');

        a.setAttribute('href', url);
        a.style.display = 'none';

        document.body.appendChild(a);
        a.dispatchEvent(e);
    }

    function useLocation(url) {
        location.href = url;
    }

    function callInIframe(url, pending) {

        console.log(url, pending);

        var iframe = document.createElement('iframe');

        iframe.id = 'callapp_iframe_' + Date.now();
        iframe.frameborder = '0';
        iframe.src = url;

        document.body.appendChild(iframe);

    }

    function normal_encode(obj, scheme) {
        obj.protocol = scheme;
        return obj2url(obj);
    }

    function intent_encode(obj, scheme, pkg_name) {
        obj.protocol = 'intent:';
        obj.hash = 'Intent;scheme=' + scheme.replace(':', '') + ';package=' + pkg_name + ';end';
        return obj2url(obj);
    }

    function tbopen_encode(obj) {
        var tbopen = 'tbopen://m.taobao.com/tbopen/index.html?action=ali.open.nav&module=h5&bootImage=0&h5Url=';

        if (alreadyTbopen(obj)) {
            obj.protocol = 'tbopen:';
            return obj2url(obj);
        } else {
            return tbopen + encodeURIComponent(obj2url(obj));
        }
    }

    function versionAbove(str, base) {
        var a, b;

        str = str.split('.');
        base = base.split('.');

        for (var i = 0, maxi = Math.max(str.length, base.length); i < maxi; i++) {
            a = parseInt(str[i] || 0);
            b = parseInt(base[i] || 0);
            if (a > b) {
                return true;
            } else if (a < b) {
                return false;
            }
        }

        return true;
    }

    function wakeup(url, options) {

        console.log('step1', url, options);

        var target = url2obj(url),
            current_path,
            ua = navigator.userAgent,
            isiOS = /iPhone|iPad|iPod/i.test(ua),
            isAnd = /Android|Linux/i.test(ua),
            isBC = ua.match(/AliApp\(BC\/([\d\.]+)/i),
            iOS9SafariFix,
            iOSYouKuFix,
            iOSQQBrowserFix,
            AndroidYouKuFix,
            AndroidBCFix,
            AndroidSamsungBrowserFix,
            AndroidOppoBrowserFix,
            AndroidUCBrowserFix,
            iOS_version;

        //PC 浏览器，直接跳转
        if ( !isiOS && !isAnd ) {
            useLocation(url);
            return;
        }

        options = options || {};

        current_path = appendParams(target, options.params, options.pass);

        console.log('step2', target);

        if (isiOS) {
            if (/youku/i.test(ua)) {
                iOSYouKuFix = true;
            } else if (/MQQBrowser/i.test(ua)) {
                iOSQQBrowserFix = true;
            } else if (/Safari/i.test(ua)) {
                //iOS >= 9.0且是Safari，需要用a标签
                iOS_version = ua.match(/Version\/([\d\.]+)/i);
                if (iOS_version && iOS_version.length == 2) {
                    iOS_version = +iOS_version[1];
                    if (iOS_version >= 9) {
                        iOS9SafariFix = true;
                    }
                }
            }
        } else {
            //一些特殊情况
            if (isBC && isBC.length == 2 && versionAbove(isBC[1], '1.9.0')) {
                //安卓百川需要用tbopen
                AndroidBCFix = true;
            } else if (/SamsungBrowser/i.test(ua)) {
                //三星原生浏览器需要用intent
                AndroidSamsungBrowserFix = true;
            } else if (/OppoBrowser/i.test(ua)) {
                AndroidOppoBrowserFix = true;
            } else if (/youku/i.test(ua)) {
                AndroidYouKuFix = true;
            } else if (/UCBrowser/i.test(ua)) {
                AndroidUCBrowserFix = true;
            }
        }

        console.log('step3', target, options);

        if (iOS9SafariFix) {
            /**
             * iOS9以上的Safari里，使用iframe打开url scheme没有任何反应
             */
            if (options.scheme === 'tbopen') {
                target = tbopen_encode(target);
            } else {
                target = normal_encode(target, options.scheme || 'taobao:');
            }

            useAnchorLink(target, options.toload);
        } else if (iOSYouKuFix || iOSQQBrowserFix) {
            useAnchorLink(tbopen_encode(target), options.toload);
        } else if ((AndroidBCFix || AndroidOppoBrowserFix || AndroidYouKuFix || AndroidUCBrowserFix) && options.scheme === undefined) {
            callInIframe(tbopen_encode(target), options.toload);
        } else if (AndroidSamsungBrowserFix) {
            useLocation(intent_encode(target, options.scheme || 'taobao:', options.pkg_name || 'com.taobao.taobao'));
        } else {
            /**
             * 在如网易的webview里，iframe的生成需要等待DOM的load事件。其表现和Safari中的非常类似，怀疑是WebKitWebView。
             */
            if (options.scheme === 'tbopen') {
                target = tbopen_encode(target);
            } else {
                target = normal_encode(target, options.scheme || 'taobao:');
            }

            callInIframe(target, options.toload);
        }
    }

    return wakeup;
});
