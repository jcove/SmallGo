@if($ad->position =='mobile_index_right_top')
    <div class="sg_index_right_top"  >
        <a type="{{$ad->name}}" href="{{$ad->url}}">
            <img alt="{{$ad->name}}" class="img-responsive" src="{{$ad->cover}}">
        </a>
    </div>
@endif