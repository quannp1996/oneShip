<?php
$router->post('/login', [
    'as'   => 'post_admin_login_form',
    'uses' => 'Controller@loginAdmin',
    'domain' => config('app.admin_url'),
]);
