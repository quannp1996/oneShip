<?php

$router->post('/reset', [
    'as'   => 'post_admin_reset_link',
    'uses' => 'Admin\Controller@sendResetLink',
    'domain' => 'admin.'. parse_url(config('app.url'))['host'],
]);

$router->get('/reset', [
    'as'   => 'get_admin_reset_form',
    'uses' => 'Admin\Controller@resetPasswordForm',
    'domain' => 'admin.'. parse_url(config('app.url'))['host'],
]);

$router->post('/password/update', [
    'as'   => 'update_password_addmin',
    'uses' => 'Admin\Controller@updatePassword',
    'domain' => 'admin.'. parse_url(config('app.url'))['host'],
]);