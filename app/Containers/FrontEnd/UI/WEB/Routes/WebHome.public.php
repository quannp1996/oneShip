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
    }
);