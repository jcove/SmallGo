<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->get('ad/{id?}/category','AdController@category');
    $router->get('ad/category','AdController@category');
    $router->resource('ad', AdController::class);
    $router->resource('category',CategoryController::class);
    $router->resource('goods',GoodsController::class);
    $router->resource('channel', ChannelController::class);
    $router->resource('nav', NavController::class);
    $router->any('/taobao/update', 'TaobaoController@update');
    $router->get('/taobao/executeUpdate/{favorites_id?}/{page_no?}', 'TaobaoController@executeUpdate')->name('taobao_execute_update');
    $router->post('/taobao/executeOne', 'TaobaoController@executeOne');
    $router->get('/taobao/coupon', 'TaobaoController@coupon');
    $router->get('/file/aether', 'FileController@aether');
});
