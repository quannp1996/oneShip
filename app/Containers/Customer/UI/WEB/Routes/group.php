<?php
$router->group([
  'prefix' => 'customers-groups',
  'domain' => config('admin_url'),
  'namespace' => 'Admin',
  'middleware' => [
    'auth:admin'
  ]
], function ($r) {

  $r->get('/', [
    'as' => 'admin.customers-groups.index',
    'uses' => 'CustomerGroupController@index',
  ]);

  $r->get('/create', [
    'as' => 'admin.customers-groups.create',
    'uses' => 'CustomerGroupController@create',
  ]);

  $r->post('/store', [
    'as' => 'admin.customers-groups.store',
    'uses' => 'CustomerGroupController@store',
  ]);

  $r->get('/{id}/edit', [
    'as' => 'admin.customers-groups.edit',
    'uses' => 'CustomerGroupController@edit',
  ]);

  $r->delete('/{id}', [
    'as' => 'admin.customers-groups.delete',
    'uses' => 'CustomerGroupController@delete',
  ]);

  $r->put('/{id}', [
    'as' => 'admin.customers-groups.update',
    'uses' => 'CustomerGroupController@update',
  ]);
});
