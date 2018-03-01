@if($ad->position =='mobile_index_left')
    <div class="sg_index_left" >
        <a href="{{ $ad->url}}" title="{{$ad->name}}">
            <img class="img-responsive" src="{{$ad->cover}}" alt="{{$ad->name}}">
        </a>
    </div>
@endif