@if(count($item->goods) > 0)
    <div class="row">
        <div class="newCate">
            <div class="hd">
                <div class="left">
                    <a href="{{url('category',['id'=>$item->id])}}" target="_blank">
                        <h3 class="name">{{$item->name}}</h3>
                    </a>
                </div>
                <div class="right">
                    <nav class="subCateList">
                        @if(count($item->child))
                            @foreach($item->child as $child)
                                @if($loop->iteration <= 7)
                                    <a class="item" href="{{url('category',['id'=>$item->id,'subId'=>$child->id])}}" target="_blank">
                                        {{$child->name}}
                                    </a>
                                    @if($loop->iteration < 7 && !$loop->last)
                                        <b class="spilt">/</b>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </nav>
                    <a class="getMore" href="{{url('category',['id'=>$item->id])}}" target="_blank">查看更多 &gt;</a>
                </div>
            </div>
            <div class="banner">
                @if(count($item->cover) > 0)
                    <a href="{{$item->cover->url}}" target="_blank" title="床品" class="wrap">
                        <img src="{{$item->cover->getCoverUrl()}}" data-original="{{$item->cover->getCoverUrl()}}" alt="床品" class="j-lazyload img-lazyload  img-lazyloaded">
                    </a>
                @endif
            </div>
            <div class="bd">
                <ul class="itemList">
                    @foreach($item->goods as $item)
                       @include('component.category-goods')
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
@endif
