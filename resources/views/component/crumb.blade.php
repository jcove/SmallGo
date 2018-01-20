@if(count($crumb) > 0)
    <div class="m-crumbs ">
        <span>
            首页
             <i class="iconfont icon-dayuhao" ></i>
        </span>

        @foreach($crumb as $row)
            @if($loop->last)
                <span>
                    {{$row['title']}}
                </span>
            @else
                <span>
                    <a class="crumb-url " href="{{$row['url']}}" >{{$row['title']}}</a>
                    <i class="iconfont icon-dayuhao" ></i>
                </span>
            @endif

        @endforeach
    </div>
@endif