<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('ad/position', AdPositionController::class);
    $router->resource('ad', AdController::class);
    $router->resource('category',CategoryController::class);
    $router->resource('goods',GoodsController::class);
    $router->resource('channel', ChannelController::class);
    $router->resource('nav', NavController::class);
    $router->any('/taobao/selection', 'TaobaoController@selection');
    // $router->get('/taobao/executeUpdate/{favorites_id?}/{page_no?}', 'TaobaoController@executeUpdate')->name('taobao.execute_update');
    $router->post('/taobao/execute-update', 'TaobaoController@executeUpdate')->name('taobao.execute_update');
    $router->post('/taobao/executeOne', 'TaobaoController@executeOne');
    $router->get('/taobao/coupon', 'TaobaoController@coupon');
    $router->get('/taobao/item/{id}', 'TaobaoController@item');
    $router->get('/file/aether', 'FileController@aether');
    $router->resource('/article', ArticleController::class);
});
