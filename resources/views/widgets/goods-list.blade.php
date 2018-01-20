
<div class="goods-list clear">
    <ul class="itemList">
        @if(!empty($list))
            @foreach($list as $item)
                @include("widgets.goods-list-item")
            @endforeach
        @endif
    </ul>
</div>