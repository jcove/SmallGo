
@foreach($list as $item)
    @include('mobile.component.goods_list_item_v')
@endforeach
<script>
    nextPageUrl                    =   '{{$list->nextPageUrl()}}';
</script>