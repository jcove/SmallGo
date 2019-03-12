@extends('pc.default.layouts.app')
@section('content')
    <div class="box">
        @include('pc.default.widgets.category_side')
        @include('pc.default.component.swiper')

    </div>

    @component('pc.default.widgets.goods-list',['route'=>'goods.item','list'=>$list])
    @endcomponent
    <div class="page-list">
        {{ $list->links() }}
    </div>

@endsection
