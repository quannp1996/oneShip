<?php
Route::group(
    [
        'prefix' => 'settings',
        'namespace' => '\App\Containers\Settings\UI\WEB\Controllers',
        'domain' => config('app.admin_url'),
        'middleware' => [
            'auth:admin',
        ],
    ],
    function () use ($router) {
        $router->get('/', [
            'as'   => 'admin_settings_edit_page',
            'uses' => 'Admin\Controller@index',
        ]);

        $router->post('/', [
            'as'   => 'admin_settings_edit_page',
            'uses' => 'Admin\Controller@edit',
        ]);

        
    }
);
