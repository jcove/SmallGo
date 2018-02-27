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
    Route::get('/category/{id}/{subId?}/{sort?}/{desc?}','CategoryController@category');
    Route::get('/channel/{id?}/{sort?}/{desc?}','ChannelController@channel');
    Route::get('/item/{id}', 'GoodsController@detail');
    Route::get('/info/{id}', 'GoodsController@info');
    Route::get('/search/goods/{keywords?}/{sort?}/{desc?}','SearchController@goods');
    Route::get('/search/coupon/{keywords?}/{page_no?}','SearchController@coupon');
    Route::get('/', 'IndexController@index')->name('home');
});
