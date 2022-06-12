<?php 
$router->group([
    'prefix' => 'customers',
    'domain' => config('admin_url'),
    'middleware' => [
        'auth:admin'
    ]
], function($r){
    $r->get('/', [
        'as'   => 'admin.customers.index',
        'uses' => 'CustomerController@index',
    ]);
    $r->get('/create', [
        'as'   => 'admin.customers.create',
        'uses' => 'CustomerController@create',
    ]);
    $r->post('/store', [
        'as'   => 'admin.customers.store',
        'uses' => 'CustomerController@store',
    ]);
    $r->delete('/{id}', [
        'as'   => 'admin.customers.delete',
        'uses' => 'CustomerController@delete',
    ]);
    $r->get('/{id}/edit', [
        'as'   => 'admin.customers.edit',
        'uses' => 'CustomerController@edit',
    ]);
    $r->put('/{id}', [
        'as'   => 'admin.customers.update',
        'uses' => 'CustomerController@update',
    ]);
    $r->post('/render-item', [
        'as'   => 'admin.customers.renderItem',
        'uses' => 'CustomerController@renderItem',
    ]);
    $r->get('/filter', [
        'as' => 'admin.customers.filter',
        'uses' => 'CustomerController@filter',
    ]);
    $r->get('/show/{id}', [
        'as' => 'admin.customers.show',
        'uses' => 'CustomerController@show',
    ]);

    $r->post('setup/price_for_shipping', [
        'as' => 'admin.customers.setup_price',
        'uses' => 'CustomerController@setUpPrice',
    ]);
});
?>
