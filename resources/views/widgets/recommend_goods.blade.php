<div class="recommend-goods-list">
    <div class="recommend-goods-list-title">
        推荐商品
    </div>
    @if(!empty($recommend_goods_list))
        @foreach($recommend_goods_list as $item)
            @include("widgets.goods-list-item")
        @endforeach
    @endif
</div>