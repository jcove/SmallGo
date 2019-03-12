<li class="item">
    <div class="product margin-auto">
        <div class="hd"><a
                    href="@if($route==='goods.info') {{route($route,['num_iid'=>$item->original_id,'title'=>urlencode($item->title)])}}?coupon_click_url={{urlencode($item->coupon_click_url)}}&coupon_amount={{$item->coupon_amount}} @else {{route($route,['id'=>$item->id,'title'=>$item->seo_title])}} @endif"
                    title="{{ $item->title }}" target="_blank"><img
                        src="{{asset('images/none.gif')}}"
                        data-src="{{get_image_url($item->cover)}}"
                        alt="{{ $item->title }}"
                        class="img lazyload"></a>
            @if(isset($item->coupon_status) && $item->coupon_status > 0)
                <span class="coupon-tip">优惠券</span>
            @endif
        </div>
        <div class="bd">
            <h4 class="name">
                <a href="@if($route==='goods.info') {{route($route,['num_iid'=>$item->original_id,'title'=>urlencode($item->title)])}}?coupon_click_url={{urlencode($item->coupon_click_url)}}&coupon_amount={{$item->coupon_amount}} @else {{route($route,['id'=>$item->id,'title'=>urlencode($item->title)])}} @endif"
                   title="{{ $item->title }}" target="_blank"><span></span><span>{{$item->name}}</span></a>
            </h4>
            <p class="price">¥ {{$item->coupon_price}}</p>
            <div>
                <hr>
            </div>
        </div>
    </div>
</li>