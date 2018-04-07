<div class="goods-list-header">
    <ul class="sort">
        <li><a class="@if($sort=='coupon_price') active @endif" href="{{route($route,array_merge(['sort'=>'coupon_price','desc'=>$desc],$params))}}">价格</a></li>
        <li><a class="@if($sort=='coupon_amount') active @endif" href="{{route($route,array_merge(['sort'=>'coupon_amount','desc'=>$desc],$params))}}">优惠大</a></li>
        <li><a class="@if($sort=='volume') active @endif" href="{{route($route,array_merge(['sort'=>'volume','desc'=>$desc],$params))}}">月销</a></li>

    </ul>
</div>