<?php
$router->get('/', [
    'as'   => 'get_admin_home_page',
    'uses'       => 'Admin\Controller@viewDashboardPage',
    'domain' => config('app.admin_url'),
    'middleware' => [
        'auth:admin'
    ],
]);
