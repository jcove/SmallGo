@if(count($list) > 0)
    @foreach($list as $item)
        @component('mobile.default.component.goods_list_item_h',['url'=>'/info','item'=>$item])
        @endcomponent
    @endforeach
@endif