<li class="item">
    <a href="{{url('info',['num_iid'=>$item->num_iid])}}?click_url={{$item->coupon_click_url}}&coupon_start_time={{$item->coupon_start_time}}&coupon_end_time={{$item->coupon_end_time}}&coupon_amount={{$item->coupon_amount}}">
    <div class="cover">
            <img class="lazyload sg-img-responsive" alt="{{ $item->title }}" data-src="{{ $item->pict_url }}"/>
        </div>
        <div class="info">
            <p class="name goods-title">{{$item->title}}</p>

            <div class="original-price-box">
                <span class="original-price">
                    淘宝价 ￥{{$item->zk_final_price}}
                </span>
                <span class="volume">
                    月销{{$item->volume}}
                </span>
            </div>
            <div class="price-box">
                <span class="goods-coupon-price">券后￥<span class="num">{{$item->coupon_price}}</span></span>
                <span class="coupon-amount"><span class="coupon-fee">{{$item->coupon_amount}}元 券</span></span>
            </div>

        </div>
    </a>
</li>
