@extends('pc.default.layouts.app')
@section('style')
    <style>
        .main {
            background-color: #f5f5f5;
        }
    </style>
@endsection
@section('content')
    <div class="g-bd-list">
        <div class="row">

            <!--商品展示区域-->
            @if(isset($list) && count($list) > 0)
                <div class="goodsArea">

                    <div class="content">
                        @component('pc.default.widgets.goods-list',['route'=>'goods.info','list'=>$list])
                        @endcomponent
                    </div>
                </div>
                <div class="page-list">
                    {{ $list->links() }}
                </div>
            @else
                @include('pc.default.widgets.empty')
            @endif
        </div>
    </div>

@endsection