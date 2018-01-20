/*jshint esversion: 6 */

import Swiper from 'swiper';
import Lazyload from 'lazyload';

lazyload();

var swiper  =   new Swiper ('.swiper-container', {
    direction: 'horizontal',
    loop: true,

    // 如果需要分页器
    pagination: '.swiper-pagination',
    // 如果需要前进后退按钮
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',


});
$('.nav-cateCard').width($(window).width());
var left               =   ($(window).width()-$('.e-nav').width())/2;
$('.nav-cateCard').css('margin-left',-left);
$('.nav-item').hover(
    function () {
        $(this).addClass("active");
        $(this).find('.nav-dropdown').stop().fadeIn(200);
    },
    function () {
        $(this).removeClass("active");
        $(this).find('.nav-dropdown').stop().fadeOut(200);
    }
);
$('.small_pic li').on('mouseover',function () {
    $('.big_pic img').attr('src',$(this).find('img').attr('src'));
    $('.small_pic li').removeClass('active');
    $(this).addClass('active');

});
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

