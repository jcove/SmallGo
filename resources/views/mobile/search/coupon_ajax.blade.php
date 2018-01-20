@if(count($list) > 0)
    @foreach($list as $item)
        @include('mobile.search.goods_list_item_h')
    @endforeach
    <script>
        setGoodsLayout();
    </script>
@endif