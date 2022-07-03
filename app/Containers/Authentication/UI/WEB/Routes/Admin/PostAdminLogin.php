<?php
$router->post('/login', [
    'as'   => 'post_admin_login_form',
    'uses' => 'Admin\Controller@loginAdmin',
    'domain' => config('app.admin_url'),
]);
