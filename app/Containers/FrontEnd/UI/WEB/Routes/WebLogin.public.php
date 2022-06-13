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
        'namespace' => 'Auth',
    ],
    function ($router) {
        
        $router->get('/login', [
            'as' => 'web_login_index',
            'uses' => 'Controller@login'
        ]);

        $router->get('/register', [
            'as' => 'web_register_index',
            'uses' => 'Controller@register'
        ]);
    }
);