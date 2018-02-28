<li class="item">
    <a href="{{url('item',['id'=>$item->id])}}">
        <div class="cover">
            <div class="img">
                <img class="lazyload img-responsive" alt="{{$item->name}}" data-src="{{$item->cover}}"/>
            </div>

        </div>
        <div class="info">
            <p class="goods-title">{{$item->name}}</p>
            @if($item->coupon_status > 0)
                <div class="original-price-box">
                    <p class="original-price">
                        {{!empty($item->from_site) ?$item->from_site:'淘宝'}}价 ￥{{$item->price}}
                    </p>
                    <p class="volume">
                        月销{{$item->volume or 0}}
                    </p>
                </div>
                <div class="price-box">
                    <p class="goods-price"><span class="tips">券后</span><span class="price">￥{{$item->coupon_price}}</span></p>
                    <p class="coupon-info text-right"><span class="coupon-fee">{{$item->coupon_amount}} 元券</span></p>
                </div>
            @else
                <div class="price-box no-coupon">
                    <p class="goods-price"> {{!empty($item->from_site) ?$item->from_site:'淘宝'}}价<span class="price">￥{{$item->coupon_price}}</span></p>
                    <p class="volume">
                        月销{{$item->volume or 0}}
                    </p>
                </div>
            @endif


        </div>
    </a>
</li>
