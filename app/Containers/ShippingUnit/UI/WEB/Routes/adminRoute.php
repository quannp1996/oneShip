<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'shipping_unit',
        'domain' => config('app.admin_url'),
        'namespace' => '\App\Containers\ShippingUnit\UI\WEB\Controllers\Admin',
        'middleware' => [
            'auth:admin',
        ],
    ],
    function($router) {
        $router->get('/', [
            'as' => 'admin_shipping_unit_index',
            'uses' => 'Controller@index',
        ]);

        $router->get('/add', [
            'as' => 'admin_shipping_unit_create',
            'uses' => 'Controller@create',
        ]);

        $router->post('/store', [
            'as' => 'admin_shipping_unit_store',
            'uses' => 'Controller@store',
        ]);

        $router->get('/edit/{id}', [
            'as' => 'admin_shipping_unit_edit',
            'uses' => 'Controller@edit',
        ]);

        $router->post('/update/{id}', [
            'as' => 'admin_shipping_unit_update',
            'uses' => 'Controller@update',
        ]);

        $router->delete('/delete/{id}', [
            'as' => 'admin_shipping_unit_delete',
            'uses' => 'Controller@delete',
        ]);

        $router->post('/shipping_const/delete/{id}', [
            'as' => 'admin_shipping_const_delete',
            'uses' => 'Controller@deleteShippingCost',
        ]);

        $router->post('/shipping_const/save', [
            'as' => 'admin_shipping_const_store',
            'uses' => 'Controller@saveShippingConst'
        ]);

        $router->post('/shipping_const/update/{id}', [
            'as' => 'admin_shipping_const_update',
            'uses' => 'Controller@updateShippingConst'
        ]);

        $router->post('/shipping_const/set_default/{id}', [
            'as' => 'admin_shipping_const_set_default',
            'uses' => 'Controller@setDefault'
        ]);
    }
)
?>