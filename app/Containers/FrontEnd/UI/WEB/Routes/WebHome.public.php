<?php

/** @var Route $router */

use App\Containers\Localization\Actions\CheckSegmentLanguageAction;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => [
            'htmloptimized',
            'Maintenance',
            'WebLocaleRedirect'
        ],
        'namespace' => 'Desktop\Home',
    ],
    function ($router) {
        $router->get('/', ['as'   => 'web.home.index', 'uses' => 'Controller@index',]);
        $router->get('/thank-you', ['as'   => 'web.thankyou.index', 'uses' => 'Controller@thankyou',]);
    }
);