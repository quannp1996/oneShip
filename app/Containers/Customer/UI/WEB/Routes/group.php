<?php
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
