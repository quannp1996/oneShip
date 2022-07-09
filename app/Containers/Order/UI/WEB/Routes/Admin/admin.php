<?php

$router->group([
  'prefix' => 'orders',
  'domain' => config('app.admin_url'),
  'namespace' => 'Admin',
  'middleware' => [
    'auth:admin',
  ],
], function () use ($router) {

  $router->get('/', [
    'as' => 'admin.orders.index',
    'uses'  => 'OrderController@index',
  ]);

  $router->get('/create', [
    'as' => 'admin.order.add',
    'uses' => 'OrderController@create',
  ]);

  $router->post('/store', [
    'as' => 'admin.order.store',
    'uses' => 'OrderController@store',
  ]);

  $router->get('logs/{id}', [
    'as' => 'admin.orders.logs',
    'uses'  => 'OrderLogController@logs',
    'middleware' => [
      'auth:admin',
    ],
  ]);

  $router->get('show/{id}', [
    'as' => 'admin.orders.show',
    'uses'  => 'OrderController@show',
    'middleware' => [
      'auth:admin',
    ],
  ]);

  $router->get('{id}/edit', [
    'as' => 'admin.orders.edit',
    'uses'  => 'OrderController@edit',
  ]);

  $router->put('update/{id}', [
    'as' => 'admin.orders.update',
    'uses'  => 'OrderController@update',
  ]);

  // Route for process order
  // $router->group(['prefix' => 'process'], function () use ($router) {
  //   $router->any('/accept/{id}', [
  //     'as' => 'admin.orders.process.accept',
  //     'uses' => 'OrderProcessController@acceptOrder',

  //   ]);

  //   // Tiếp nhận lại đơn hàng
  //   $router->any('/accept-again/{id}', [
  //     'as' => 'admin.orders.process.accept-again',
  //     'uses' => 'OrderProcessController@acceptOrdergain',

  //   ]);

  //   // Đánh dấu là đơn hàng đã được xuất khỏi kho
  //   $router->any('/export/{id}', [
  //     'as' => 'admin.orders.process.export',
  //     'uses' => 'OrderProcessController@exportOrder',
  //   ]);

  //   // Đánh dấu là đơn hàng đang được giao
  //   $router->any('/delivering/{id}', [
  //     'as' => 'admin.orders.process.delivering',
  //     'uses' => 'OrderProcessController@deliveringOrder',
  //   ]);

  //   // Đánh dấu là đơn hàng đã được giao thành công
  //   $router->any('/deliveried/{id}', [
  //     'as' => 'admin.orders.process.deliveried',
  //     'uses' => 'OrderProcessController@deliveriedOrder',
  //   ]);

  //   $router->any('/un-accept/{id}', [
  //     'as' => 'admin.orders.process.un-accept',
  //     'uses' => 'OrderProcessController@unAcceptOrder',
  //   ]);

  //   $router->any('/waiting-paid/{id}', [
  //     'as' => 'admin.orders.process.waiting-paid',
  //     'uses' => 'OrderProcessController@markWaitingPaymentOrder',
  //   ]);

  //   $router->any('/confirm-paid/{id}', [
  //     'as' => 'admin.orders.process.confirm-paid',
  //     'uses' => 'OrderProcessController@markPaidOrder',
  //   ]);

  //   $router->any('/finish/{id}', [
  //     'as' => 'admin.orders.process.finish',
  //     'uses' => 'OrderProcessController@markFinishOrder',
  //   ]);

  //   $router->any('/refund/{id}', [
  //     'as' => 'admin.orders.process.refund',
  //     'uses' => 'OrderProcessController@markRefundOrder',
  //   ]);

  //   $router->any('/cancel/{id}', [
  //     'as' => 'admin.orders.process.cancel',
  //     'uses' => 'OrderProcessController@markCancelOrder',
  //   ]);

  //   $router->post('/resend-mail/{id}', [
  //     'as' => 'admin.orders.process.resend-mail',
  //     'uses' => 'OrderProcessController@resendOrderMail',
  //   ]);
  // });

  // // Route for note order
  // $router->group(['prefix' => 'note'], function () use ($router) {
  //   $router->get('/list/{orderId}', [
  //     'as' => 'admin.orders.note.index',
  //     'uses' => 'OrderNoteController@index',
  //   ]);

  //   $router->get('/create/{orderId}', [
  //     'as' => 'admin.orders.note.create',
  //     'uses' => 'OrderNoteController@create',
  //   ]);

  //   $router->post('/store/{orderId}', [
  //     'as' => 'admin.orders.note.store',
  //     'uses' => 'OrderNoteController@store',
  //   ]);
  // });

  // Push Order to Shipping
  $router->get('/shipping/push/{id}', [
    'as' => 'admin.orders.shipping.push',
    'uses' => 'ShippingOrderController@push'
  ]);
});
