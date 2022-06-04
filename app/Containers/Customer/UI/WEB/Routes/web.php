<?php

$router->get('/customers', [
    'as'   => 'admin.customers.index',
    'uses' => 'CustomerController@index',
    'middleware' => [
      'auth:admin'
    ]
]);

$router->get('/customers/create', [
  'as'   => 'admin.customers.create',
  'uses' => 'CustomerController@create',
  'middleware' => [
    'auth:admin'
  ]
]);


$router->post('/customers/store', [
  'as'   => 'admin.customers.store',
  'uses' => 'CustomerController@store',
  'middleware' => [
    'auth:admin'
  ]
]);

$router->delete('/customers/{id}', [
  'as'   => 'admin.customers.delete',
  'uses' => 'CustomerController@delete',
  'middleware' => [
    'auth:admin'
  ]
]);

$router->get('/customers/{id}/edit', [
  'as'   => 'admin.customers.edit',
  'uses' => 'CustomerController@edit',
  'middleware' => [
    'auth:admin'
  ]
]);

$router->put('/customers/{id}', [
  'as'   => 'admin.customers.update',
  'uses' => 'CustomerController@update',
  'middleware' => [
    'auth:admin'
  ]
]);

$router->post('/customers/render-item', [
  'as'   => 'admin.customers.renderItem',
  'uses' => 'CustomerController@renderItem',
  'middleware' => [
    'cors'
  ]
]);

$router->get('/customers/filter', [
  'as' => 'admin.customers.filter',
  'uses' => 'CustomerController@filter',
  'middleware' => [
    'auth:admin'
  ]
]);

// Customer groups
$router->get('/customers-groups/create', [
  'as' => 'admin.customers-groups.create',
  'uses' => 'CustomerGroupController@create',
  'middleware' => [
    'auth:admin'
  ]
]);

$router->get('/customers-groups', [
  'as' => 'admin.customers-groups.index',
  'uses' => 'CustomerGroupController@index',
  'middleware' => [
    'auth:admin'
  ]
]);

$router->post('/customers-groups/store', [
  'as' => 'admin.customers-groups.store',
  'uses' => 'CustomerGroupController@store',
  'middleware' => [
    'auth:admin'
  ]
]);

$router->get('/customers-groups/{id}/edit', [
  'as' => 'admin.customers-groups.edit',
  'uses' => 'CustomerGroupController@edit',
  'middleware' => [
    'auth:admin'
  ]
]);

$router->delete('/customers-groups/{id}', [
  'as' => 'admin.customers-groups.delete',
  'uses' => 'CustomerGroupController@delete',
  'middleware' => [
    'auth:admin'
  ]
]);

$router->put('/customers-groups/{id}', [
  'as' => 'admin.customers-groups.update',
  'uses' => 'CustomerGroupController@update',
  'middleware' => [
    'auth:admin'
  ]
]);



