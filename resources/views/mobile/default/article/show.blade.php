@extends('mobile.default.layouts.layout')
@section('content')
    <div class="article-detail">
       <div class="cover">
           <img class="img-responsive" src="{{$post->cover}}" alt="{{$post->title}}">
       </div>
        <div class="info">
            <p class="title">
                {{$post->title}}
            </p>
            <p class="pub-date">
                {{$post->created_at}}
            </p>
        </div>
        <div class="article-body">
                {!! $post->body !!}
        </div>
    </div>

@endsection
@section('script')
    <script>
        $('a[href="'+"{{url('article')}}"+'"]').closest('li').addClass('active');
    </script>
@endsection