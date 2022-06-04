<?php
Route::group(
[
    'prefix' => 'roles_management',
    'namespace' => '\App\Containers\Authorization\UI\WEB\Controllers\Admin',
    'domain' => config('app.admin_url'),
    'middleware' => [
        'auth:admin',
    ],
],function () use ($router) {
    $router->get('/', [
        'as' => 'admin_authorization_get_all_roles',
        'uses'       => 'Controller@getAllRoles',
    ]);

    $router->get('/edit/{id}', [
        'as' => 'admin_authorization_edit_role',
        'uses'       => 'Controller@findRole',
        
    ]);

    $router->delete('/edit/{id}', [
        'as' => 'admin_authorization_delete_role',
        'uses'       => 'Controller@deleteRole',
    ]);

    $router->get('/add', [
        'as' => 'admin_authorization_add_role',
        'uses'       => 'Controller@addRole',
    ]);

    $router->post('/add', [
        'as' => 'admin_authorization_add_role',
        'uses'       => 'Controller@createRole',
    ]);

    $router->post('/edit/{id}', [
        'as' => 'admin_authorization_edit_role',
        'uses'       => 'Controller@updateRole',
    ]);

    $router->delete('/{id}', [
        'as' => 'admin_authorization_delete_role',
        'uses'       => 'Controller@deleteRole',
    ]);
});