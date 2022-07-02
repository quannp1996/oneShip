<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'shipping',
    'domain' => config('app.url'),
    'namespace' => '\App\Containers\ShippingUnit\UI\WEB\Controllers\FrontEnd',
], 
    function($router) {
        $router->post('caculateFees', [
            'as' => 'web_caculate_fees',
            'uses' => 'Controller@caculateFees'
        ]);
    }
)
?>