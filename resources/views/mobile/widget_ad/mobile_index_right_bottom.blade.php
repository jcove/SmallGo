@if($ad->position =='mobile_index_right_bottom')
    <div class="ad_index_right_bottom">
        <a href="{{$ad->url}}">
            <img alt="{{$ad->name}}" class="img-responsive" src="{{$ad->cover}}">
        </a>
    </div>
@endif