<?php
Route::group(
    [
        'prefix' => 'settings/deliverytype',
        'namespace' => '\App\Containers\Settings\UI\WEB\Controllers\DeliveryType\Admin',
        'domain' => config('app.admin_url'),
        'middleware' => [
            'auth:admin',
        ],
    ],
    function () use ($router) {
        $router->get('/', [
            'as'   => 'admin_deliverytype_home_page',
            'uses' => 'Controller@index',
        ]);

        $router->get('/edit/{id}', [
            'as'   => 'admin_deliverytype_edit_page',
            'uses' => 'Controller@edit',
        ]);

        $router->post('/edit/{id}', [
            'as'   => 'admin_deliverytype_edit_page',
            'uses' => 'Controller@update',
        ]);

        $router->get('/add', [
            'as'   => 'admin_deliverytype_add_page',
            'uses' => 'Controller@add',
        ]);

        $router->post('/add', [
            'as'   => 'admin_deliverytype_add_page',
            'uses' => 'Controller@create',
        ]);

        $router->delete('/delete/{id}', [
            'as' => 'admin_deliverytype_delete',
            'uses'       => 'Controller@delete',
        ]);

        $router->post('/enable/{id}',[
            'as' => 'admin_deliverytype_enable',
            'uses'       => 'Controller@enable',
        ]);

        $router->post('/disable/{id}',[
            'as' => 'admin_deliverytype_disable',
            'uses'       => 'Controller@disable',
        ]);
    }
);
