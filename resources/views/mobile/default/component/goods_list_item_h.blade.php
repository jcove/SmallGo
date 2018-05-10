<li class="item">
    <a href="@if($route==='goods.info') {{route($route,['num_iid'=>$item->original_id,'title'=>$item->seo_title])}} @else {{route($route,['id'=>$item->id,'title'=>$item->seo_title])}} @endif" title="{{$item->title}}">
        <div class="cover-box">
            <div class="cover">
                <img class="lazyload img-responsive" alt="{{$item->name}}" data-src="{{ $item->cover }}"/>
            </div>
        </div>

        <div class="info">
            <div class="name goods-title">{{$item->name}}</div>
            <div class="volume"> 月销:{{$item->volume}}</div>

            <div class="price-box">
                <span class="goods-price "> {{!empty($item->from_site) ?$item->from_site:'淘宝'}}￥{{$item->price}}</span>
                @if($item->coupon_status > 0)
                    <span class="coupon-amount">{{$item->coupon_amount}}元 券</span>
                @else
                    <span class="no-coupon">&nbsp;</span>
                @endif
            </div>

        </div>

    </a>
</li>
