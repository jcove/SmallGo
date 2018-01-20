<li class="item">
    <a href="{{ url($url,['id'=>$item->id]) }}">
        <div class="cover">
            <img class="lazyload img-responsive" alt="{{$item->name}}" data-src="{{ $item->cover }}"/>
        </div>
        <div class="info">
            <p class="name goods-title">{{$item->name}}</p>
            @if($item->coupon_status > 0)
                <div class="original-price-box">
                    <span class="original-price">
                        {{!empty($item->from_site) ?$item->from_site:'淘宝'}}价￥{{$item->price}}
                    </span>
                    <span class="volume">
                        月销{{$item->volume}}
                    </span>
                </div>
                <div class="price-box">
                    <span class="goods-coupon-price ">券后￥<span class="num">{{$item->coupon_price}}</span></span>
                    <span class="coupon-amount"><span class="coupon-fee">{{$item->coupon_amount}}元 券</span></span>
                </div>
            @else
                <div class="price-box no-coupon">
                    <span class="goods-coupon-price"> {{!empty($item->from_site) ?$item->from_site:'淘宝'}}价￥<span class="num">{{$item->coupon_price}}</span></span>
                    <span class="volume">
                        月销{{$item->volume}}
                    </span>
                </div>
            @endif
        </div>
    </a>
</li>
