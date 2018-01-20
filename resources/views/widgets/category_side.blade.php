@if(count($categories) > 0)
    <div class="category-side pull-left">
        <ul>
            @foreach($categories as $category)
                @if($loop->index <8)
                <li class="item">
                    <i class="{{$category->icon}}"></i>
                    <a href="{{ url('category',['id'=>$category->id]) }}" title="{{ $category->name }}">{{$category->name}}</a>
                </li>
                @endif
            @endforeach
        </ul>
    </div>

@endif