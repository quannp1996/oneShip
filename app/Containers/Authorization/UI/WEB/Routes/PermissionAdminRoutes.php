<?php
Route::group(
[
    'prefix' => 'perms_management',
    'namespace' => '\App\Containers\Authorization\UI\WEB\Controllers\Admin',
    'domain' => config('app.admin_url'),
    'middleware' => [
        'auth:admin',
    ],
],function () use ($router) {
    $router->get('/', [
        'as' => 'admin_authorization_get_all_perms',
        'uses'       => 'Controller@getAllPermissions',
    ]);

    $router->get('/edit/{id}', [
        'as' => 'admin_authorization_edit_perm',
        'uses'       => 'Controller@findPermission',
    ]);

    $router->post('/edit/{id}', [
        'as' => 'admin_authorization_edit_perm',
        'uses'       => 'Controller@updatePermission',
    ]);

    $router->get('/add', [
        'as' => 'admin_authorization_add_perm',
        'uses'       => 'Controller@addPermission',
    ]);

    $router->post('/add', [
        'as' => 'admin_authorization_add_perm',
        'uses'       => 'Controller@createPermission',
    ]);

});