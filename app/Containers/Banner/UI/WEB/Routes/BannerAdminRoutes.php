<?php
Route::group(
    [
        'prefix' => 'banner',
        'namespace' => '\App\Containers\Banner\UI\WEB\Controllers\Admin',
        'domain' => config('app.admin_url'),
        'middleware' => [
            'auth:admin',
        ],
    ],
    function () use ($router) {
        $router->get('/', [
            'as'   => 'admin_banner_home_page',
            'uses' => 'Controller@index',
        ]);

        $router->get('/edit/{id}', [
            'as'   => 'admin_banners_edit_page',
            'uses' => 'Controller@edit',
        ]);

        $router->post('/edit/{id}', [
            'as'   => 'admin_banners_edit_page',
            'uses' => 'Controller@update',
        ]);

        $router->get('/add', [
            'as'   => 'admin_banners_add_page',
            'uses' => 'Controller@add',
        ]);

        $router->post('/add', [
            'as'   => 'admin_banners_add_page',
            'uses' => 'Controller@create',
        ]);

        $router->delete('/delete/{id}', [
            'as' => 'admin_banners_delete',
            'uses'       => 'Controller@delete',
        ]);

        $router->post('/enable/{id}',[
            'as' => 'admin_banners_enable',
            'uses'       => 'Controller@enable',
        ]);

        $router->post('/disable/{id}',[
            'as' => 'admin_banners_disable',
            'uses'       => 'Controller@disable',
        ]);
    }
);
