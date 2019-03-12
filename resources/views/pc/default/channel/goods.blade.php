@extends('pc.default.layouts.app')

@section('content')
    <div class="container">
        <div class="g-bd-list">
            <div class="row">
                <div class="banner">
                    @if(!empty($cover))
                        <a href="{{$cover->url}}" target="_blank" title="{{$cover->name}}" class="wrap">
                            <img src="{{ asset('home/images/loading.gif') }}" data-src="{{$cover->cover}}" alt="{{$cover->name}}" class="lazyload">
                        </a>
                    @endif
                </div>

                <!--商品展示区域-->
                <div class="goodsArea" >
                    <div class="sortbar">
                        <div class="sorts" style="border-top:none">
                            <span class="name">排序：</span>
                            <a href="{{ route('channel.show',['id'=>$id,'title'=>$channel->seo_title]) }}" class="sort sort-default @if($sort=='id') active @endif">默认</a>
                            <a href="{{ route('channel.show',['id'=>$id,'title'=>$channel->seo_title,'sort'=>'price']) }}" class="sort sort-price @if($sort=='price') active @endif"><span>价格</span>
                                <div class="icon">
                                    <i class="iconfont icon-down1"></i>
                                </div>
                            </a>
                            <a href="{{ route('channel.show',['id'=>$id,'title'=>$channel->seo_title,'sort'=>'created_at']) }}" class="sort sort-time @if($sort=='created_at') active @endif" >
                                <span>上架时间</span>
                                <i class="iconfont icon-down2"></i>
                            </a>
                        </div>
                    </div>
                    <div class="content">
                        @component('pc.default.widgets.goods-list',['route'=>'goods.item','list'=>$list])
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
        <div class="page-list">
            {{ $list->links() }}
        </div>
    </div>

@endsection