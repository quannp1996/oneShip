<?php
Route::group(
[
    'prefix' => 'users',
    'namespace' => '\App\Containers\User\UI\WEB\Controllers\Admin',
    'domain' => config('app.admin_url'),
    'middleware' => [
        'auth:admin',
    ],
],function () use ($router) {
    $router->get('/log', [
        'as'   => 'admin_user_log',
        'uses' => 'UserLogController@index',
    ]);
    $router->get('/log/{id}', [
        'as'   => 'admin_user_log_detail',
        'uses' => 'UserLogController@detail',
    ]);
    $router->get('/log/{id}/view', [
        'as'   => 'admin_user_log_detail_dump',
        'uses' => 'UserLogController@dump',
    ]);

    $router->get('/', [
        'as'   => 'get_user_home_page',
        'uses' => 'UserController@index',
    ]);

    $router->get('/edit/{id}', [
        'as'   => 'admin_user_edit_page',
        'uses' => 'UserController@editUser',
    ]);

    $router->post('/edit/{id}', [
        'as'   => 'admin_user_edit_page',
        'uses' => 'UserController@updateUser',
    ]);

    $router->get('/add', [
        'as'   => 'admin_user_add_page',
        'uses' => 'UserController@addUser',
    ]);

    $router->post('/add', [
        'as'   => 'admin_user_add_page',
        'uses' => 'UserController@createUser',
    ]);

    $router->delete('/delete/{id}', [
        'as'    => 'admin_user_delete',
        'uses'  => 'UserController@delete',
    ]);

    $router->post('/active/{id}', [
        'as'   => 'admin_user_active',
        'uses' => 'UserController@active',
    ]);

    $router->get('/active-log', [
        'as' => 'admin.user.active_log',
        'uses' => 'UserController@activeLog'
    ]);

    $router->get('/filter', [
      'as' => 'admin.user.filter',
      'uses' => 'UserController@filterUser'
    ]);
});
