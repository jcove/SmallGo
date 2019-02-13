<div class="recommend-goods-list">
    <div class="recommend-goods-list-title">
        推荐商品
    </div>
    @if(!empty($recommend_goods_list))
        @foreach($recommend_goods_list as $item)
            @component("pc.default.widgets.goods-list-item",['route'=>'goods.info','item'=>$item])
            @endcomponent
        @endforeach
    @else
        <p style="text-align: center">暂无推荐哦</p>

    @endif
</div>