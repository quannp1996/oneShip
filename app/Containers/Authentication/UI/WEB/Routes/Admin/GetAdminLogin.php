<?php
$router->get('/login', [
    'as'   => 'get_admin_login_page',
    'uses' => 'Controller@showLoginPage',
    'domain' => config('app.admin_url'),
    'middleware' => [
        'authenticated:admin'
    ],
]);
