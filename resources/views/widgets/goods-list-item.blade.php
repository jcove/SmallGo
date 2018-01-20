<li class="item">
    <div class="product margin-auto">
        <div class="hd"><a
                    href="{{$item->id >0  ? url('/item',['id'=>$item->id]) : url('/info',['num_iid'=>$item->original_id]) }}"
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
                <a href="{{url('item',['id'=>$item->id])}}"
                   title="{{ $item->title }}" target="_blank"><span></span><span>{{$item->name}}</span></a>
            </h4>
            <p class="price">¥ {{$item->price}}</p>
            <div>
                <hr>
            </div>
        </div>
    </div>
</li>