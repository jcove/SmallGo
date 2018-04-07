import Swiper from 'swiper';
import IScroll from 'iscroll';
import Lazyload from 'lazyload';

window.Lazyload = Lazyload;
window.IScroll  =   IScroll;
var deviceWidth         =   document.body.clientWidth;
window.deviceWidth                  =   deviceWidth;

window.onload = function () {
    let swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        loop: true,
        speed: 600,
        autoplay: 1000,
        onTouchEnd: function() {
            swiper.startAutoplay();
        }
    });

    $('#keywords').keyup(function ($event) {
        if($event.keyCode==13){
            window.location.href=$('.go-search').data('url')+'/'+$('#keywords').val();
        }
    });
    $('.go-search').on('click',function () {
        if($('#keywords').val()!=''){
            window.location.href=$(this).data('url')+'/'+$('#keywords').val();
        }
    });
    lazyload();
    setGoodsLayout();
    $(window).scroll(function(){
//获取窗口的滚动条的垂直位置
        var s = $(window).scrollTop();
//当窗口的滚动条的垂直位置大于页面的最小高度时，让返回顶部元素渐现，否则渐隐
        if( s > 800){
            $("#go-top").fadeIn(100);
        }else{
            $("#go-top").fadeOut(200);
        }
    });
    $('#go-top').on('click',function () {
        $('html,body').animate({scrollTop:0},800);
    });

};
function get(url,query,callback) {
    url                         =   SMALL_GO.APP_URL+'/'+url;
    $.get(url,query,callback);
}
window.nextPageUrl                          =   '';
window.setNextPageUrl=function (url) {
    window.nextPageUrl                      =   url;
}
window.setGoodsLayout=function() {
    //商品列表宽度计算
    // var goodsItemWidth                      =   deviceWidth/2-3;
    // $('.goods-list-h  .item').width(goodsItemWidth).height(goodsItemWidth/5*8).css('margin-bottom',6);
    // $('.goods-list-h  .item:odd').css('margin-left',3);
    // $('.goods-list-h  .item:even').css('margin-right',3);
}
var loading                             =   false;
var haveDate                            =   true;
window.nextPage=function(url,container) {
    var $loading                        =   $('<div class="loading">加载中...</div>');

    if(!loading&&haveDate){
        loading                         =   true;
        $(container).append($loading);
        $.get(url,null,function (response) {
            if(response){
                $(container).append(response);
                lazyload();
            }else {

                $(container).parent().parent().append(' <div class="no-more">————— 已经扯到底了! —————</div>');
                haveDate                =   false;

            }
            loading                     =   false;
            $loading.remove();
        },'html')
    }

};

