<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'contact',
        'namespace' => '\App\Containers\Contact\UI\WEB\Controllers\Admin',
        'domain' => config('app.admin_url'),
        'middleware' => [
            'auth:admin',
        ],
    ],
    function () use ($router) {
        $router->get('/', [
            'as'   => 'admin_contact_home_page',
            'uses' => 'Controller@index',
        ]);

        $router->get('/export', [
            'as'   => 'admin_contact_export',
            'uses' => 'Controller@export',
        ]);

        $router->get('/edit/{id}', [
            'as'   => 'admin_contacts_edit_page',
            'uses' => 'Controller@edit',
        ]);

        $router->post('/edit/{id}', [
            'as'   => 'admin_contacts_edit_page',
            'uses' => 'Controller@update',
        ]);

        $router->get('/add', [
            'as'   => 'admin_contacts_add_page',
            'uses' => 'Controller@add',
        ]);

        $router->post('/add', [
            'as'   => 'admin_contacts_add_page',
            'uses' => 'Controller@create',
        ]);

        $router->delete('/delete/{id}', [
            'as' => 'admin_contacts_delete',
            'uses'       => 'Controller@delete',
        ]);

        $router->post('/enable/{id}',[
            'as' => 'admin_contacts_enable',
            'uses'       => 'Controller@enable',
        ]);

        $router->post('/disable/{id}',[
            'as' => 'admin_contacts_disable',
            'uses'       => 'Controller@disable',
        ]);
    }
);
