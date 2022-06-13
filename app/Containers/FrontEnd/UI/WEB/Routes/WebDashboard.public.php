<?php

/** @var Route $router */

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => [
            'htmloptimized',
            'Maintenance',
            'WebLocaleRedirect',
        ],
        'namespace' => 'Dashboard',
    ],
    function ($router) {
        $router->get('/', [
            'as' => 'web_dashboard_index',
            'uses' => 'Controller@dashboard'
        ]);
        $router->get('/ship/estimate', [
            'as' => 'web_estimate_index',
            'uses' => 'Estimate@estimate'
        ]);
        $router->get('/order', [
            'as' => 'web_orders_index',
            'uses' => 'Order@orders'
        ]);
    }
);