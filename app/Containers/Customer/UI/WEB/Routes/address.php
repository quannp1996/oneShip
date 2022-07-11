<?php
$router->group([
    'prefix' => 'customers/address',
    'namespace' => 'FrontEnd',
    'domain' => config('app.url'),
], function ($r) {
    $r->get('/list', [
        'as' => 'web_customer_address_list',
        'uses' => 'CustomerAddress@listAddress'
    ]);
    $r->post('/store', [
        'as' => 'web_customer_address_store',
        'uses' => 'CustomerAddress@storeAddress'
    ]);
    $r->delete('/delete/{id}', [
        'as' => 'web_customer_address_delete',
        'uses' => 'CustomerAddress@deleteAddress'
    ]);

    $r->post('/update/{id}', [
        'as' => 'web_customer_address_update',
        'uses' => 'CustomerAddress@deleteAddress'
    ]);
});
