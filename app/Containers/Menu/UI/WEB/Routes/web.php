<?php

$router->get('menu/create', [
  'as' => 'admin_menu_add',
  'uses'  => 'Controller@create',
  'middleware' => [
    'auth:admin',
  ],
]);

$router->delete('menu/{id}', [
  'as' => 'admin_menu_delete',
  'uses'  => 'Controller@delete',
  'middleware' => [
    'auth:admin',
  ],
]);

$router->get('menu/{id}/edit', [
  'as' => 'admin_menu_edit',
  'uses'  => 'Controller@edit',
  'middleware' => [
    'auth:admin',
  ],
]);

$router->get('menu/{id}', [
  'as' => 'admin_menu_show',
  'uses'  => 'Controller@show',
  'middleware' => [
    'auth:admin',
  ],
]);

$router->get('menu', [
  'as' => 'admin_menu_index',
  'uses'  => 'Controller@index',
  'middleware' => [
    'auth:admin',
  ],
]);

$router->post('menu/store', [
  'as' => 'admin_menu_store',
  'uses'  => 'Controller@store',
  'middleware' => [
    'auth:admin',
  ],
]);


$router->post('menu/position', [
  'as' => 'admin_menu_position',
  'uses' => 'Controller@updatePosition',
  'middleware' => [
    'auth:admin'
  ]
]);

$router->match(['POST', 'PUT'],'menu/{id}', [
  'as' => 'admin_menu_update',
  'uses' => 'Controller@update',
  'middleware' => [
    'auth:admin'
  ]
]);

$router->any('menu/type/{typeId}', [
  'as' => 'admin_menu_getbytype',
  'uses' => 'Controller@getMenusByType',
  'middleware' => [
    'auth:admin'
  ]
]);
