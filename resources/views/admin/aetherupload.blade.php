<div class="box box-info">
    <div class="box-header with-border">
        <p>如何实现自动导入，<a href="http://www.361dream.com/article/62" target="_blank">点我看教程</a></p>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal">
        <div class="box-body">
            <div class="form-group " id="aetherupload-wrapper">
                <label class="col-sm-2 control-label">联盟商品excel上传：</label>
                <div class="col-sm-8">
                    <input type="file" id="file" onchange="aetherupload(this,'file').upload()"/>
                    <div class="progress "
                         style="height: 6px;margin-bottom: 2px;margin-top: 10px;width: 200px;">
                        <div id="progressbar" style="background:blue;height:6px;width:0;"></div>
                    </div>
                    <span style="font-size:12px;color:#aaa;" id="output"></span>
                    <input type="hidden" name="file2" id="savedpath">
                </div>
            </div>
        </div>

    </form>
</div>