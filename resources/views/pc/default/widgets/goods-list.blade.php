
<div class="goods-list clear">
    <ul class="itemList">
        @if(!empty($list))
            @foreach($list as $item)
                @component("pc.default.widgets.goods-list-item",['route'=>$route,'item'=>$item])
                @endcomponent
            @endforeach
        @endif
    </ul>
</div>