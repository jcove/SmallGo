
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>名称</th>
                            <th>价格</th>
                            <th>更新状态</th>
                        </tr>
                        @if(count($list) > 0)
                            @foreach($list as  $item)
                                <tr>
                                    <td class="id-field" >{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>
                                        <i class="fa fa-check" style="color: green"></i>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
<script>
    {{--var  total          =   {{$total}};--}}
    var  i              =   1;
    var timer                       =   null;
    var next_page_url   =   '{{$next_page_url}}';
    if(next_page_url!=''){
        toastr.success('第{{$page_no}}页采集完成,即将采集下一页');
        setTimeout(function () {
            $.pjax({
                url: next_page_url,
                container: '#pjax-container'
            });
        },3000);
    }else {
        toastr.success("更新成功",null);
    }


    {{--$(function () {--}}
        {{--var array                       =   [];--}}
        {{--var tmpArray                    =   [];--}}

        {{--$('.id-field').each(function () {--}}
            {{--var  that                   =   $(this);--}}
            {{--var data                    =   $(this).data('text');--}}
            {{--array[data.num_iid]         =   {obj:that,data:data};--}}
            {{--tmpArray.push({obj:that,data:data});--}}
        {{--});--}}
        {{--toastr.success('即将开始采集...');--}}
        {{--setTimeout(function () {--}}
            {{--var j=0;--}}

            {{--timer                               =   setInterval(function () {--}}
                {{--if(j<tmpArray.length){--}}
                    {{--// var url                     =   tmpArray[j].data.coupon_click_url;--}}
                    {{--// if(url){--}}
                    {{--//     url                         =   url.replace(/coupon\/edetail/ig, "cp/coupon");--}}
                    {{--//--}}
                    {{--//     $.ajax({--}}
                    {{--//         url: url,--}}
                    {{--//         dataType: 'jsonp',--}}
                    {{--//         jsonp: 'callback',--}}
                    {{--//         success: function(result) {--}}
                    {{--//             if(result.succ)--}}
                    {{--//             if (result.status === '1111') {--}}
                    {{--//                 alert('啊噢！阿里妈妈访问限制啦请切换IP或者等待几分钟');--}}
                    {{--//                 return;--}}
                    {{--//             }--}}
                    {{--//             console.log(result);--}}
                    {{--//             array[result.result.item.itemId].data.coupon_amount      =   result.result.amount;--}}
                    {{--//             array[result.result.item.itemId].data.coupon_start_fee   =   result.result.startFee;--}}
                    {{--//             array[result.result.item.itemId].data.coupon_click_url   =   result.result.item.shareUrl;--}}
                    {{--//             execute(array[result.result.item.itemId].obj,array[result.result.item.itemId].data);--}}
                    {{--//         }--}}
                    {{--//     });--}}
                    {{--// }else {--}}
                        {{--execute(tmpArray[j].obj,tmpArray[j].data);--}}
                   {{--// }--}}
                    {{--j++;--}}
                {{--}--}}
            {{--},1000)--}}
        {{--},1000)--}}
    {{--});--}}
    {{--function execute(that,data) {--}}
        {{--$.post("{{url('admin/taobao/executeOne')}}",data,function (response) {--}}
            {{--that.next().next().next().find('i').removeClass('fa-circle-o').addClass('fa-check').css('color','green');--}}
            {{--if(i==20){--}}
                {{--if(next_page_url!=''){--}}
                    {{--$.pjax({--}}
                        {{--url: next_page_url,--}}
                        {{--container: '#pjax-container'--}}
                    {{--});--}}
                {{--}else {--}}
                    {{--toastr.success("更新成功",null);--}}
                    {{--clearInterval(timer);--}}
                {{--}--}}
            {{--}--}}
            {{--i++;--}}
        {{--});--}}
    {{--}--}}

</script>