<div class="goods-list-v">
    @if(!empty($list_title))
        <div class="sg-list-header">
            {{$list_title}}
        </div>
    @endif
    @if(count($list) > 0)
        <ul id="goods-list-result" class="list">
            @foreach($list as $item)
                @include('mobile.component.goods_list_item_v')
            @endforeach
        </ul>
    @endif

</div>