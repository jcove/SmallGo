<section style="width: 100%;background-color: white">
    <div class="footer">
        <ul>
            @if(count($navs) > 0)
                @foreach($navs as $nav)
                    <li class="smallgo-nav-item">
                        <a href="{{$nav->link}}">
                            <i class="{{$nav->icon}}"></i>
                            <p class="">{{$nav->title}}</p>
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
        <script>
            var count           =   '{{count($navs)}}'!=='' ? parseInt('{{count($navs)}}') : 1;
            $('.smallgo-nav-item').width($('.footer').width()/count);
        </script>
    </div>
    <div id="go-top">
        <i class="iconfont icon-totop"></i>
    </div>
</section>

