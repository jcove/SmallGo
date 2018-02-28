<div class="goods-list-h ">
    @if(isset($title) )
        <div class="header">
            <div class="title">
                <p>
                    {{$title}}
                </p>
            </div>
        </div>
    @endif

    @if(count($list) > 0)
        <ul id="result">
            @foreach($list as $item)
                @component('mobile.default.component.goods_list_item_h',['url'=>$url,'item'=>$item])
                @endcomponent
            @endforeach
        </ul>
    @endif
</div>