<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <!-- /.box-header -->
                <!-- form start -->
                <form id="update-form" action="/admin/taobao/execute-update" method="post" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" pjax-container="">
                    <div class="box-body">

                        <div class="fields-group">

                            <div class="form-group  ">

                                <label for="name" class="col-sm-2 control-label">选品库</label>

                                <div class="col-sm-8">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <select id="favorites_id" name="favorites_id" class="form-control" >
                                            @foreach($favorites as $favorite)
                                                <option value="{{$favorite->favorites_id}}" {{ isset($favorites_id) && $favorites_id == $favorite->favorites_id ? 'selected="selected"' : '' }}>{{$favorite->favorites_title}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                        <input name="_token" value="{{csrf_token()}}" type="hidden"><div class="col-md-2">
                        </div>
                        <div class="col-md-8">

                            <div class="btn-group pull-right">
                                <button type="submit" class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Submit">一键更新</button>
                            </div>

                            <div class="btn-group pull-left">
                                <button type="reset" class="btn btn-warning">Reset</button>
                            </div>

                        </div>

                    </div>
                    <input name="_previous_" value="{{url('taobao/update')}}" class="_previous_" type="hidden"><!-- /.box-footer -->
                    <input type="hidden" name="page_no" value={{ isset($page_no) ? $page_no : 1 }}>
                </form>
            </div>
        </div>
    </div>
</section>