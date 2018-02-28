
@if(count($list))
    @foreach($list as $item)
        @component('mobile.default.component.goods_list_item_h',['url'=>'/item','item'=>$item])
        @endcomponent
    @endforeach
    <script>
        setGoodsLayout();
    </script>
@endif
