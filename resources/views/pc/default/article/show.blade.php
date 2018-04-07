@extends('layouts.default')
@section('body')
    <div class="col-md-3">
        @if(!empty($post->author))
        <div id="sticker-sticky-wrapper" class="sticky-wrapper" style="height: 436px;">
            <div id="sticker" style="">

                <div class="panel panel-default corner-radius">

                    <div class="panel-heading text-center">
                        <h3 class="panel-title">作者：{{$post->author->name or '本站'}}</h3>
                    </div>

                    <div class="panel-body text-center topic-author-box">
                        <a href="{{route('user.profile',['id'=>$post->author->id])}}">
                            <img src="{{$post->author->avatar or asset('images/default_avatar.png')}}"
                                 style="width:80px; height:80px;margin:5px;" class="img-thumbnail avatar">
                        </a>

                        <div class="media-body padding-top-sm">
                            <div class="media-heading">
                                <svg width="14" height="16"  class="Icon Icon--male" aria-hidden="true" style="height: 16px; width: 14px;fill:#9fadc7;margin-bottom: 3px"><title></title>
                                </svg>
                                <span class="introduction"></span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="col-md-9">
        <div class="panel panel-default article">
            <!-- Default panel contents -->

            <div class="panel-body">
                <div class="article-header">
                    <h1 class="title text-center">{{$post->title}}</h1>
                    <div class="article-meta text-center">
                        <i class="iconfont icon-yidiandiantubiao18"></i> <abbr title="{{$post->created_at}}" class="timeago">{{local_time_format($post->created_at)}}</abbr>
                        ⋅
                        <i class="iconfont icon-view-1"></i> {{$post->view}}
                        ⋅
                        <i class="iconfont icon-messagexinxi"></i> {{$post->comments}}
                    </div>
                </div>
                <div class="entry-content">
                    <div class="content-body entry-content panel-body ">
                        <div class="article-body-content" id="emojify">
                            {!! $post->body !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="replies panel panel-default list-panel replies-index" id="replies">

            <div class="panel-heading">
                <div class="total">评论</div>
            </div>

            <div class="panel-body">
                <ul class="list-group comment-list row">
                    @foreach($comments as $item)
                        <li class="list-group-item media" style="margin-top: 0px;">
                            <div class="avatar avatar-container pull-left">
                                <a href="">
                                    <img class="media-object img-thumbnail avatar avatar-middle"
                                         alt="{{$item->author->name}}"
                                         src="{{$item->author->avatar or asset('images/default_avatar.png')}}"
                                         style="width:55px;height:55px;">
                                </a>
                            </div>
                            <div class="infos">
                                <div class="media-heading">
                                    <a href="" title="DavidNineRoc"
                                       class="remove-padding-left author rm-link-color">
                                        {{$item->author->name}}
                                    </a>
                                    <span class="introduction"></span>
                                    <span class="operate pull-right">
                         <a class="fa fa-reply" href="javascript:void(0)"
                            onclick="replyOne('{{$item->author->name}}',{{$item->author->id}});"
                            title="回复">
                             <i class="iconfont icon-comment" style="font-size:14px;"></i>
                         </a>
                    </span>
                                    <div class="meta">
                                        <a name="reply34639" id="reply34639" class="anchor" href="#reply34639"
                                           aria-hidden="true">#{{$loop->index+1}}</a>
                                        <span> ⋅  </span>
                                        <abbr class="timeago"
                                              title="{{$item->created_at}}">{{ local_time_format($item->created_at)}}</abbr>
                                    </div>
                                </div>

                                <div class="media-body markdown-reply content-body">
                                    <p>
                                        @if(!empty($item->replayAuthor))
                                            <a href="">@ {{ $item->replayAuthor->name }}</a> @endif{{$item->body}}
                                    </p>
                                </div>

                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="reply-box form box-block">
            <form method="POST" comment-pjax action="{{url('/comment')}}" accept-charset="UTF-8" id="reply-form">
                {{--<div id="reply_notice" class="box">--}}
                {{--<ul class="helpblock list rm-link-color add-link-underline">--}}
                {{--<li>请注意单词拼写，以及中英文排版，<a href="https://github.com/sparanoid/chinese-copywriting-guidelines">参考此页</a></li>--}}
                {{--<li>支持 Markdown 格式, <strong>**粗体**</strong>、~~删除线~~、<code>`单行代码`</code>, 更多语法请见这里 <a href="https://github.com/riku/Markdown-Syntax-CN/blob/master/syntax.md">Markdown 语法</a></li>--}}
                {{--<li>支持表情，使用方法请见 <a href="https://laravel-china.org/topics/45" target="_blank">Emoji 自动补全来咯</a>，可用的 Emoji 请见 <img title=":metal:" alt=":metal:" class="emoji" src="https://dn-phphub.qbox.me/assets/images/emoji/metal.png" align="absmiddle"> <img title=":point_right:" alt=":point_right:" class="emoji" src="https://dn-phphub.qbox.me/assets/images/emoji/point_right.png" align="absmiddle"> <a href="https://laravel-china.org/ecc/index.html" target="_blank" rel="nofollow"> Emoji 列表 </a> <img title=":star:" alt=":star:" class="emoji" src="https://dn-phphub.qbox.me/assets/images/emoji/star.png" align="absmiddle"> <img title=":sparkles:" alt=":sparkles:" class="emoji" src="https://dn-phphub.qbox.me/assets/images/emoji/sparkles.png" align="absmiddle"> </li>--}}
                {{--<li>上传图片, 支持拖拽和剪切板黏贴上传, 格式限制 - jpg, png, gif</li>--}}
                {{--<li>发布框支持本地存储功能，会在内容变更时保存，「提交」按钮点击时清空</li>--}}
                {{--</ul>--}}
                {{--</div>--}}
                <div class="alert alert-dismissable alert-info">
                    <i class="fa fa-info" aria-hidden="true"></i> &nbsp;&nbsp;请勿发布不友善或者负能量的内容。与人为善，比聪明更重要！
                </div>

                <div class="form-group">
                    <textarea class="form-control" rows="5" placeholder=""
                              style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 164px;"
                              id="reply_content" name="body" cols="50"></textarea>
                </div>

                <div class="form-group reply-post-submit">
                    <input name="article_id" type="hidden" value="{{$post->id}}">
                    <input id="replay_author_id" name="replay_author_id" type="hidden" value="0">
                    {{ csrf_field() }}
                    <input class="btn btn-primary " id="reply-create-submit" value="回复" type="submit">
                    <span class="help-inline" title="Or Command + Enter">Ctrl+Enter</span>
                </div>

                <div class="box preview markdown-reply" id="preview-box" style="display:none;"></div>

            </form>
        </div>
    </div>

@endsection
@section('style')
    <link href="{{asset('vendor/imageviewer/viewer.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css')}}">
    <style>
        .syntaxhighlighter a, .syntaxhighlighter div, .syntaxhighlighter code, .syntaxhighlighter, .syntaxhighlighter td, .syntaxhighlighter tr, .syntaxhighlighter tbody, .syntaxhighlighter thead, .syntaxhighlighter caption, .syntaxhighlighter textarea{
            vertical-align: middle!important;
        }
    </style>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('vendor/ueditor/third-party/SyntaxHighlighter/shCore.js')}}"></script>
    <script src="{{asset('vendor/imageviewer/viewer.min.js')}}"></script>
    <script>

        $(function () {
            $('.article-body-content').viewer();
            console.log('a');
        });
        $.get("{{url('/comment/lists',['article_id'=>$post->id])}}").success(function (response) {
            $('#pjax-comment-box').append(response);
            $(document).on('submit', 'form[comment-pjax]', function (event) {
                $.pjax.submit(event, '#pjax-comment-box')
            })
        });
    </script>
    <script>
        SyntaxHighlighter.all();
        function replyOne(username, author) {
            //  $('#replay_author_id').val(author);
            replyContent = $("#reply_content");
            oldContent = replyContent.val();
            let prefix = "@" + username + " ";
            newContent = ''
            if (oldContent.length > 0) {
                if (oldContent != prefix) {
                    newContent = oldContent + "\n" + prefix;
                }
            } else {
                newContent = prefix
            }
            replyContent.focus();
            replyContent.val(newContent);
            moveEnd($("#reply_content"));
        }

        var moveEnd = function (obj) {
            obj.focus();

            var len = obj.value === undefined ? 0 : obj.value.length;

            if (document.selection) {
                var sel = obj.createTextRange();
                sel.moveStart('character', len);
                sel.collapse();
                sel.select();
            } else if (typeof obj.selectionStart == 'number' && typeof obj.selectionEnd == 'number') {
                obj.selectionStart = obj.selectionEnd = len;
            }
        }
    </script>

@endsection