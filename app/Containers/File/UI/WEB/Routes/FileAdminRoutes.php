<?php
Route::group(
    [
        'prefix' => 'file',
        'namespace' => '\App\Containers\File\UI\WEB\Controllers\Admin',
        'domain' => config('app.admin_url'),
        'middleware' => [
            'auth:admin',
        ],
    ],
    function () use ($router) {
        $router->get('/laravel-filemanager', [
            'as'   => 'admin_category_home_page',
            'uses' => 'Controller@index',
        ]);

        $router->group(['prefix' => 'laravel-filemanager'], function () {
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });
    }
);
