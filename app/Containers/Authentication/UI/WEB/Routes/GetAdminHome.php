<?php
$router->get('/', [
    'as'   => 'get_admin_home_page',
    'uses'       => '\App\Containers\DashBoard\UI\WEB\Controllers\Admin\Controller@viewDashboardPage',
    'domain' => config('app.admin_url'),
    'middleware' => [
        'auth:admin'
    ],
]);
