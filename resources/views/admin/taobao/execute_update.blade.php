@include('admin.taobao.update')
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

    $(function () {
        
        var  i             =   1;
        var timer          =   null;
        var next_page_url  =   '{{$next_page_url}}';
        $('select').bind('change', function (event) {
            $('input[name=page_no]').val(1);
        });

        if(next_page_url!=''){
            toastr.success('第{{$page_no}}页采集完成,即将采集下一页');
            setTimeout(function () {

                $('input[name=page_no]').val({{ $page_no + 1 }});
                $('#update-form').submit();
            },3000);
        }else {
            toastr.success("已更新第" + {{ $page_no }}  + " 更新成功", null);
        }
    });
</script>