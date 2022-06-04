<?php
Route::group(
    [
        'prefix' => 'settings/paymenttype',
        'namespace' => '\App\Containers\Settings\UI\WEB\Controllers\PaymentType\Admin',
        'domain' => config('app.admin_url'),
        'middleware' => [
            'auth:admin',
        ],
    ],
    function () use ($router) {
        $router->get('/', [
            'as'   => 'admin_paymenttype_home_page',
            'uses' => 'Controller@index',
        ]);

        $router->get('/edit/{id}', [
            'as'   => 'admin_paymenttype_edit_page',
            'uses' => 'Controller@edit',
        ]);

        $router->post('/edit/{id}', [
            'as'   => 'admin_paymenttype_edit_page',
            'uses' => 'Controller@update',
        ]);

        $router->get('/add', [
            'as'   => 'admin_paymenttype_add_page',
            'uses' => 'Controller@add',
        ]);

        $router->post('/add', [
            'as'   => 'admin_paymenttype_add_page',
            'uses' => 'Controller@create',
        ]);

        $router->delete('/delete/{id}', [
            'as' => 'admin_paymenttype_delete',
            'uses'       => 'Controller@delete',
        ]);

        $router->post('/enable/{id}',[
            'as' => 'admin_paymenttype_enable',
            'uses'       => 'Controller@enable',
        ]);

        $router->post('/disable/{id}',[
            'as' => 'admin_paymenttype_disable',
            'uses'       => 'Controller@disable',
        ]);
    }
);
