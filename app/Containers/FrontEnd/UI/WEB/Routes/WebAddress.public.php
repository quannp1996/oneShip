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

        $router->get('/address', [
            'as' => 'web_orders_address',
            'uses' => 'Address@address'
        ]);
    }
);