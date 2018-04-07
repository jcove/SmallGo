@extends('layouts.default')
@section('body')
    <div class="box">
        <form action="@if(isset($article->id) && $article->id > 0){{route('article.update',['article'=>$article->id])}}@else{{route('article.store')}}@endif"
              method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">标题</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="标题"
                       value="{{isset($article->title) ? $article->title : ''}}">
            </div>
            <div class="form-group">
                <label>分类</label>

                <select class="form-control" name="category_id" id="category_id">
                    <option value="0">请选择分类</option>
                    @if(count($categories))
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    @endif
                    @if(isset($article->category_id))
                        <script>
                            $("#category_id option[value={{$article->category_id}}]").attr("selected", "selected");
                        </script>
                    @endif
                </select>

            </div>

            <div class="form-group">
                <label>内容</label>
                <script id="container" name="body" type="text/plain">{!! $article->body or '' !!}</script>
            </div>
            <div class="form-group row">
                @if(isset($article->id) && $article->id > 0)
                    <input name="id" type="hidden" value="{{isset($article->id) ? $article->id : 0}}">
                    {{ method_field('PUT') }}
                @endif

                {{ csrf_field() }}
                <button id="submit" type="submit" class="btn btn-success col-md-offset-4 col-md-4 btn-lg">发 布</button>
            </div>

        </form>


    </div>
@endsection
@section('script')

    <script src="{{asset('vendor/ueditor/ueditor.config.js')}}"></script>
    <script src="{{asset('vendor/ueditor/ueditor.all.js')}}"></script>





    <script type="text/javascript">
        var ue = UE.getEditor('container',{
            initialFrameHeight:800,
            serverUrl:"{{route('ueditor')}}",
            enableAutoSave:true
        });

    </script>
@endsection