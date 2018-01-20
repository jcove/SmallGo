<div  class="recommend-box">
    <p class="title"><img src="{{asset('images/h.png')}}">&nbsp;&nbsp;&nbsp;精选频道</p>
    <div id="iscroll">
        <ul>
            @foreach($channels as $item)
                <li class="">
                    <div class="item">
                        <a href="{{url('channel',['id'=>$item->id])}}">
                            <img src="{{$item->cover}}">
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

</div>