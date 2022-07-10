<?php
$router->group([
    'prefix' => 'auth/customer',
    'namespace' => 'FrontEnd',
    'domain' => config('app.url'),
], function($r) {
    $r->post('/register', [
        'as'   => 'web_regiser_post',
        'uses'       => 'AuthController@customerRegister',
    ]);

    $r->post('/login', [
        'as'   => 'web_customer_login_post',
        'uses'       => 'AuthController@customerLogin',
    ]);
});