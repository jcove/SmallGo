<div class="goods-list-header">
    <ul class="sort">
        <li><a class="@if($sort=='id') active @endif" href="{{route($route,array_merge(['sort'=>'id','desc'=>$desc],$params))}}">推荐</a></li>
        <li><a class="@if($sort=='created_at') active @endif" href="{{route($route,array_merge(['sort'=>'created_at','desc'=>'desc'],$params))}}">最新</a></li>
        <li><a class="@if($sort=='volume') active @endif" href="{{route($route,array_merge(['sort'=>'volume','desc'=>'desc'],$params))}}">月销</a></li>
    </ul>
</div>