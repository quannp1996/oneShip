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
        'domain' => config('app.url'),
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
        $router->get('/orders', [
            'as' => 'web_orders_index',
            'uses' => 'Order@orders'
        ]);
        $router->get('/order/create', [
            'as' => 'web_orders_create',
            'uses' => 'Order@create'
        ]);
        $router->any('/order/export', [
            'as' => 'web_orders_export',
            'uses' => 'Order@export'
        ]);
    }
);