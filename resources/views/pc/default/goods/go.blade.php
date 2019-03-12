@extends('pc.default.layouts.app')
@section('content')
    <div class="container">
        <a class="go_pay"  style="display:none;" data-tao_num_iid ="{{$id}}" data-tao_pid="{{config('taobao.pid')}}"  target="_blank" href="http://item.taobao.com/item.htm?id={{$id}}" data-type="0" biz-itemid="{{$id}}"  data-style="2"  data-tmpl="0" data-weburl="{{url()->current()}}"></a>
    </div>

@endsection
@section('script')
    <script>
        $(function(){

            let btn = $(".go_pay").eq(0);
            let org_url = btn.attr('href');
            let pid = btn.attr('data-tao_pid');
            let wt = '0';
            let ti = '625';
            let tl = '230x45';
            let rd = '1';
            let ct = encodeURIComponent('itemid='+btn.attr('data-tao_num_iid'));
            let st = '2';
            let url = btn.attr('data-weburl') ? btn.attr('data-weburl') :document.URL;
            let rf = encodeURIComponent(url);
            let et = get_et();
            let pgid = get_pgid();
            let v = '2.0';
            $.ajax({
                url: 'http://g.click.taobao.com/display?cb=?',
                type: 'GET',
                dataType: 'jsonp',
                jsonp: 'cb',
                data: 'pid='+pid+'&wt='+wt+'&ti='+ti+'&tl='+tl+'&rd='+rd+'&ct='+ct+'&st='+st+'&rf='+rf+'&et='+et+'&pgid='+pgid+'&v='+v,
                success: function(msg) {
                    if(msg.code == 200 || msg.code == 201){
                        if(window.location.href.indexOf('shop')   ==-1  ){
                            url = msg.data.items[0].ds_item_click;
                        }else{
                            url = msg.data.items[0].ds_shop_click;
                        }
                        document.location.href = url;
                    }
                    else{
                        console.log(msg.error_msg);
                        return;
                        document.location.href = org_url;
                    }
                },
                error: function(msg){
                    document.location.href = org_url;
                }
            });

        });
        function setCookie(j, k)
        {
            document.cookie = j + "=" + encodeURIComponent(k.toString()) + "; path=/"
        }

        function getCookie(l)
        {
            let m = (" " + document.cookie).split(";"),
                j = "";
            for (let k = 0; k < m.length; k++) {
                if (m[k].indexOf(" " + l + "=") === 0) {
                    j = decodeURIComponent(m[k].split("=")[1].toString());
                    break
                }
            }
            return j
        }
        function get_et(){
            let s = new Date(),
                l = +s / 1000 | 0,
                r = s.getTimezoneOffset() * 60,
                p = l + r,
                m = p + (3600 * 8),
                q = m.toString().substr(2, 8).split(""),
                o = [6, 3, 7, 1, 5, 2, 0, 4],
                n = [];
            for (let k = 0; k < o.length; k++) {
                n.push(q[o[k]])
            }
            n[2] = 9 - n[2];
            n[4] = 9 - n[4];
            n[5] = 9 - n[5];
            return n.join("")
        }
        function get_pgid(){
            let l = "",
                k = "",
                n,
                o,
                t,
                u,
                s = location,
                m = "",
                q = Math;
            function r(x, z) {
                let y = "",
                    v = 1,
                    w;
                v = Math.floor(x.length / z);
                if (v == 1) {
                    y = x.substr(0, z)
                } else {
                    for (w = 0; w < z; w++) {
                        y += x.substr(w * v, 1)
                    }
                }
                return y
            }

            n = (" " + document.cookie).split(";");
            for (o = 0; o < n.length; o++) {
                if (n[o].indexOf(" cna=") === 0) {
                    k = n[o].substr(5, 24);
                    break
                }
            }

            if (k === "") {
                cu = (s.search.length > 9) ? s.search: ((s.pathname.length > 9) ? s.pathname: s.href).substr(1);
                n = document.cookie.split(";");
                for (o = 0; o < n.length; o++) {
                    if (n[o].split("=").length > 1) {
                        m += n[o].split("=")[1]
                    }
                }
                if (m.length < 16) {
                    m += "abcdef0123456789"
                }
                k = r(cu, 8) + r(m, 16)
            }
            for (o = 1; o <= 32; o++) {
                t = q.floor(q.random() * 16);
                if (k && o <= k.length) {
                    u = k.charCodeAt(o - 1);
                    t = (t + u) % 16
                }
                l += t.toString(16)
            }
            setCookie('amvid', l);
            let p = getCookie('amvid');
            if (p) {
                return p
            }
            return l
        }

    </script>
@endsection