@if(count($list))
    @foreach($list as $item)
        @component('mobile.component.goods_list_item_h',['url'=>'/item','item'=>$item])
        @endcomponent
    @endforeach
@endif
