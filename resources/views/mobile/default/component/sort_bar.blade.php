<div class="goods-list-header">
    <ul class="sort">
        <li><a class="@if($sort=='price') active @endif" href="{{url($url,['sort'=>'price','desc'=>$desc])}}">价格</a></li>
        <li><a class="@if($sort=='coupon_amount') active @endif" href="{{url($url,['sort'=>'coupon_amount','desc'=>$desc])}}">优惠大</a></li>
        <li><a class="@if($sort=='volume') active @endif" href="{{url($url,['sort'=>'volume','desc'=>$desc])}}">月销</a></li>

    </ul>
</div>