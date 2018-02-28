@if(count($categories) > 0)
    <div class="category-side margin-auto">
        <ul>
            @foreach($categories as $category)
                @if($loop->index <8)
                    <a href="{{ url('category',['id'=>$category->id]) }}"
                       title="{{ $category->name }}">
                        <li class="item">
                            <span class="icon">
                                 <i class="{{$category->icon}}"></i>
                            </span>
                            <p class="">{{$category->name}}</p>
                        </li>
                    </a>
                @endif
            @endforeach
        </ul>
    </div>

@endif