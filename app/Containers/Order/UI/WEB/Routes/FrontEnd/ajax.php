<?php

$router->group([
    'prefix' => 'orders',
    'domain' => config('app.url'),
    'namespace' => 'FrontEnd'
], function () use ($router) {
    $router->get('/', [
        'as' => 'ajax.orders.index',
        'uses'  => 'Controller@apiList',
    ]);

    $router->post('/store', [
        'as' => 'ajax.orders.store',
        'uses'  => 'Controller@apiStore',
    ]);
});
