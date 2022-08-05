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
        'prefix' => 'page',
        'namespace' => 'Dashboard',
    ],
    function ($router) {
        $router->get('/{id}', [
            'as' => 'web_staticpage_detail',
            'uses' => 'StaticPage@detail'
        ]);
    }
);