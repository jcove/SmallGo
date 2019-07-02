<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function () {
    Route::get('/ad/banner', 'AdController@banner');
    Route::get('/nav', 'NavController@list');
    Route::get('/category/tree', 'CategoryController@tree');
    Route::get('/category/{id}', 'CategoryController@info');

    Route::get('/goods', 'GoodsController@list');
    Route::get('/goods/{id}', 'GoodsController@info');
    Route::get('/goods/tb/{id}', 'GoodsController@tb');
    Route::get('/search/goods', 'SearchController@goods');
    Route::get('/search/coupon', 'SearchController@coupon');
});
