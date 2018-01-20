<?php

use Illuminate\Routing\Router;

Route::group([
        'prefix'        => 'api',
        'namespace'     => 'App\\Api\\Controllers',
        ], function (Router $router) {
        Route::get('ad/banner', 'AdController@banner');
});
