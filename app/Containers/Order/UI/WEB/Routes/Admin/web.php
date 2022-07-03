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
    'middleware' => [
      'auth:admin',
    ],
  ]);

  $router->put('update/{id}', [
    'as' => 'admin.orders.update',
    'uses'  => 'OrderController@update',
    'middleware' => [
      'auth:admin',
    ],
  ]);

  // Route for process order
  $router->group(['prefix' => 'process'], function () use ($router) {
    $router->any('/accept/{id}', [
      'as' => 'admin.orders.process.accept',
      'uses' => 'OrderProcessController@acceptOrder',
      'middleware' => [
        'auth:admin'
      ]
    ]);

    // Tiếp nhận lại đơn hàng
    $router->any('/accept-again/{id}', [
      'as' => 'admin.orders.process.accept-again',
      'uses' => 'OrderProcessController@acceptOrdergain',
      'middleware' => [
        'auth:admin'
      ]
    ]);

    // Đánh dấu là đơn hàng đã được xuất khỏi kho
    $router->any('/export/{id}', [
      'as' => 'admin.orders.process.export',
      'uses' => 'OrderProcessController@exportOrder',
      'middleware' => [
        'auth:admin'
      ]
    ]);

    // Đánh dấu là đơn hàng đang được giao
    $router->any('/delivering/{id}', [
      'as' => 'admin.orders.process.delivering',
      'uses' => 'OrderProcessController@deliveringOrder',
      'middleware' => [
        'auth:admin'
      ]
    ]);

    // Đánh dấu là đơn hàng đã được giao thành công
    $router->any('/deliveried/{id}', [
      'as' => 'admin.orders.process.deliveried',
      'uses' => 'OrderProcessController@deliveriedOrder',
      'middleware' => [
        'auth:admin'
      ]
    ]);

    $router->any('/un-accept/{id}', [
      'as' => 'admin.orders.process.un-accept',
      'uses' => 'OrderProcessController@unAcceptOrder',
      'middleware' => [
        'auth:admin'
      ]
    ]);

    $router->any('/waiting-paid/{id}', [
      'as' => 'admin.orders.process.waiting-paid',
      'uses' => 'OrderProcessController@markWaitingPaymentOrder',
      'middleware' => [
        'auth:admin'
      ]
    ]);

    $router->any('/confirm-paid/{id}', [
      'as' => 'admin.orders.process.confirm-paid',
      'uses' => 'OrderProcessController@markPaidOrder',
      'middleware' => [
        'auth:admin'
      ]
    ]);

    $router->any('/finish/{id}', [
      'as' => 'admin.orders.process.finish',
      'uses' => 'OrderProcessController@markFinishOrder',
      'middleware' => [
        'auth:admin'
      ]
    ]);

    $router->any('/refund/{id}', [
      'as' => 'admin.orders.process.refund',
      'uses' => 'OrderProcessController@markRefundOrder',
      'middleware' => [
        'auth:admin'
      ]
    ]);

    $router->any('/cancel/{id}', [
      'as' => 'admin.orders.process.cancel',
      'uses' => 'OrderProcessController@markCancelOrder',
      'middleware' => [
        'auth:admin'
      ]
    ]);

    $router->post('/resend-mail/{id}', [
      'as' => 'admin.orders.process.resend-mail',
      'uses' => 'OrderProcessController@resendOrderMail',
      'middleware' => [
        'auth:admin'
      ]
    ]);
  });

  // Route for note order
  $router->group(['prefix' => 'note'], function () use ($router) {
    $router->get('/list/{orderId}', [
      'as' => 'admin.orders.note.index',
      'uses' => 'OrderNoteController@index',
      'middleware' => [
        'auth:admin'
      ]
    ]);

    $router->get('/create/{orderId}', [
      'as' => 'admin.orders.note.create',
      'uses' => 'OrderNoteController@create',
      'middleware' => [
        'auth:admin'
      ]
    ]);

    $router->post('/store/{orderId}', [
      'as' => 'admin.orders.note.store',
      'uses' => 'OrderNoteController@store',
      'middleware' => [
        'auth:admin'
      ]
    ]);
  });
});
