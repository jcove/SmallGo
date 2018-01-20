@if(count($list))
    @foreach($list as $item)
        @include('mobile.component.goods_list_item_h')
    @endforeach
    <script>
        setGoodsLayout();
    </script>
@endif