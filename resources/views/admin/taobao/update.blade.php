<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Create</h3>

                    <div class="box-tools">
                        <div class="btn-group pull-right" style="margin-right: 10px">
                            <a href="http://homestead.app/console/ad" class="btn btn-sm btn-default"><i class="fa fa-list"></i>&nbsp;List</a>
                        </div> <div class="btn-group pull-right" style="margin-right: 10px">
                            <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{request()->getRequestUri()}}" method="post" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" pjax-container="">
                    <div class="box-body">

                        <div class="fields-group">

                            <div class="form-group  ">

                                <label for="name" class="col-sm-2 control-label">选品库</label>

                                <div class="col-sm-8">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <select id="favorites_id" name="favorites_id" class="form-control" >
                                            @foreach($favorites as $favorite)
                                                <option value="{{$favorite->favorites_id}}">{{$favorite->favorites_title}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                        <input name="_token" value="{{csrf_token()}}" type="hidden"><div class="2">
                        </div>
                        <div class="8">

                            <div class="btn-group pull-right">
                                <button type="submit" class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Submit">一键更新</button>
                            </div>

                            <div class="btn-group pull-left">
                                <button type="reset" class="btn btn-warning">Reset</button>
                            </div>

                        </div>

                    </div>

                    <input name="_previous_" value="http://homestead.app/console/ad" class="_previous_" type="hidden"><input name="_previous_" value="{{url('taobao/update')}}" class="_previous_" type="hidden"><!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>