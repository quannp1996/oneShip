<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'field',
        'namespace' => '\App\Containers\Field\UI\WEB\Controllers\Admin',
        'domain' => config('app.admin_url'),
        'middleware' => [
            'auth:admin',
        ],
    ],
    function () use ($router) {
        $router->get('/', [
            'as'   => 'admin_field_home_page',
            'uses' => 'Controller@index',
        ]);

        $router->get('/edit/{id}', [
            'as'   => 'admin_fields_edit_page',
            'uses' => 'Controller@edit',
        ]);

        $router->post('/edit/{id}', [
            'as'   => 'admin_fields_update_page',
            'uses' => 'Controller@update',
        ]);

        $router->get('/add', [
            'as'   => 'admin_fields_add_page',
            'uses' => 'Controller@create',
        ]);

        $router->post('/store', [
            'as'   => 'admin_fields_store_page',
            'uses' => 'Controller@store',
        ]);

        $router->delete('/delete/{id}', [
            'as' => 'admin_fields_delete',
            'uses'       => 'Controller@delete',
        ]);

        $router->post('/enable/{id}',[
            'as' => 'admin_fields_enable',
            'uses'       => 'Controller@enable',
        ]);

        $router->post('/disable/{id}',[
            'as' => 'admin_fields_disable',
            'uses'       => 'Controller@disable',
        ]);
    }
);
