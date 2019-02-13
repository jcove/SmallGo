<!-- 头部 -->
<nav class="navbar navbar-small">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">{{config('app.name')}}</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @foreach($navs as $nav)
                    <li><a href="{{$nav->link}}">{{$nav->title}}</a></li>
                @endforeach
            </ul>
            <form class="navbar-form navbar-right" role="search" action="{{route('search.coupon')}}" method="get">
                <div class="form-group">
                    <input type="text" name="keywords" value="{{isset($keywords) ? $keywords : ''}}" class="form-control" placeholder="关键词">
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-default">搜券</button>
            </form>
        </div><!-- /.navbar-collapse -->

    </div><!-- /.container-fluid -->
</nav>