@extends('layouts.app')
@section('content')
    <div class="box">
        @include('widgets.category_side')
        @include('component.swiper')

    </div>

    @include('widgets.goods-list')
    <div class="page-list">
        {{ $list->links() }}
    </div>

@endsection
