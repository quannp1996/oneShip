<?php

Route::group(
    [
        'prefix' => 'profile',
        'namespace' => '\App\Containers\Profile\UI\WEB\Controllers\Admin',
        'domain' => config('app.admin_url'),
        'middleware' => [
            'auth:admin',
        ], 
    ],
    function() use ($router) {
        $router->get('/',[
            'as' => 'admin_profile_page',
            'uses' => 'Controller@index',
        ]);

        $router->post('/',[
            'as' => 'admin_profile_page',
            'uses' => 'Controller@update',
        ]);
    }
)
?>