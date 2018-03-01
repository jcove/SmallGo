<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\Auth;
Route::any('/wechat', 'WeChatController@serve');
Route::get('/channel/option','ChannelController@options');
Route::get('/category/option','CategoryController@options');
Route::get('/test','TestController@index');
Route::get('/taobao/app','TaobaoController@openApp');
Route::get('/goods/recommend','TaobaoController@recommend')->name('taobao.recommend');
Route::any('/taobao/client/collect','TaobaoController@saveClientCollect');
Route::group(['middleware'=>['web','category']], function(){
    Auth::routes();
    Route::get('/go/{num_iid}','GoodsController@go');
    Route::get('/category/lists','CategoryController@lists');
    Route::get('/category/{id}/{title?}/{subId?}/{sort?}/{desc?}','CategoryController@category')->name('category.show');
    Route::get('/channel/{id}/{title?}/{sort?}/{desc?}','ChannelController@channel')->name('channel.show');
    Route::get('/item/{id}/{title?}', 'GoodsController@detail')->name('goods.item');
    Route::get('/info/{id}/{title?}', 'GoodsController@info')->name('goods.info');
    Route::get('/search/goods/{keywords?}/{sort?}/{desc?}','SearchController@goods');
    Route::any('/search/coupon/{keywords?}/{page_no?}','SearchController@coupon')->name('search.coupon');
    Route::get('/', 'IndexController@index')->name('home');
});
