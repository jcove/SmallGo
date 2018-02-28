@extends('mobile.default.layouts.layout')
@section('content')
    @component('mobile.default.component.search_bar')
        @slot('url')
            {{url('search/goods')}}
        @endslot
    @endcomponent
    <section>
        <div class="category-list">
            @foreach($list as $item)
                <div class="header">
                    {{$item->name}}
                </div>
                <ul>
                    @foreach($item->children as $child)
                        <a href="{{url('category',['id'=>$item->id,'sub_id'=>$child->id])}}">
                            <li>
                                <i class="iconfont {{$child->icon}}"></i>
                                <p >{{$child->name}}</p>
                            </li>
                        </a>
                    @endforeach
                </ul>
            @endforeach

        </div>
    </section>

@endsection
@section('script')
    <script>
        $(function () {
            $('a[href="'+"{{url('category/lists')}}"+'"]').closest('li').addClass('active');
        })
    </script>
@endsection