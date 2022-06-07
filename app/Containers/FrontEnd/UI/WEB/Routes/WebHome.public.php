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
        'namespace' => 'Desktop\Home',
    ],
    function ($router) {
        
    }
);