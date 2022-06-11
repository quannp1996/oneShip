<?php

/** @var Route $router */

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => [
            'htmloptimized',
            'Maintenance',
            'WebLocaleRedirect',
            'auth:customer'
        ],
        'namespace' => 'Dashboard',
    ],
    function ($router) {
        $router->get('/', [
            'as' => 'web_dashboard_index',
            'uses' => function(){
                dd('asdsa');
            }
        ]);
    }
);