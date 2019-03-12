@if(count($list) > 0)
    @foreach($list as $item)
        @component('mobile.default.component.goods_list_item_h',['route'=>'goods.info','item'=>$item])
        @endcomponent
    @endforeach
@endif