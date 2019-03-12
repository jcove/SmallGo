@extends('pc.default.layouts.app')
@section('style')
    <style>
        .main{
            background-color: #f5f5f5;
        }
    </style>
@endsection
@section('content')
    <div class="g-bd-list">
        <div class="row">

            <!--商品展示区域-->

                <div class="goodsArea" >
                    <div class="sortbar">
                        <div class="sorts">
                            <span class="name">排序：</span>
                            <a href="{{ url('search/goods',['keywords'=>$keywords]) }}" class="sort sort-default @if($sort=='view') active @endif">默认</a>
                            <a href="{{ url('search/goods',['keywords'=>$keywords,'sort'=>'price']) }}" class="sort sort-price @if($sort=='price') active @endif"><span>价格</span>
                                <div class="icon">
                                    <i class="iconfont icon-down1"></i>
                                </div>
                            </a>
                            <a href="{{ url('search/goods',['keywords'=>$keywords,'sort'=>'date']) }}" class="sort sort-time @if($sort=='created_at') active @endif" >
                                <span>上架时间</span>
                                <i class="iconfont icon-down2"></i>
                            </a>
                        </div>
                    </div>
                    <div class="content">
                        <div class="m-Level2Category">
                            <div class="hd"><p class="title f-clearfix">

                            <ul class="itemList itemList-level2Category">
                                @if(isset($list))
                                    @foreach($list as $item)
                                        @include('component.category-goods')
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection