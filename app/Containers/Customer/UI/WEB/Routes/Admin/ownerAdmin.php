<?php
Route::group(
  [
      'prefix' => 'owner',
      'namespace' => '\App\Containers\Customer\UI\WEB\Controllers\Admin',
      'domain' => config('app.admin_subdomain').'.' . parse_url(config('app.url'))['host'],
      'middleware' => [
          'auth:admin',
      ],
  ],
  function () use ($router) {
    $router->get('/', [
          'as' => 'owner.list',
          'uses' => 'OwnerController@listOwner'
    ]);
    
    $router->get('/ajax', [
        'as' => 'owner.ajax',
        'uses' => 'OwnerController@ajaxOwner'
    ]);
    $router->get('/add', [
        'as' => 'owner.add',
        'uses' => 'OwnerController@addOwner'
    ]);
    $router->post('/store', [
        'as' => 'owner.store',
        'uses' => 'OwnerController@storeOwner'
    ]);
    
    $router->get('/edit/{id}', [
        'as' => 'owner.edit',
        'uses' => 'OwnerController@editOwner'
    ]);

    $router->post('/update/{id}', [
        'as' => 'owner.update',
        'uses' => 'OwnerController@updateOwner'
    ]);

    $router->get('/detail/{id}', [
        'as' => 'owner.detail',
        'uses' => 'OwnerController@showOwner'
    ]);

    $router->get('/block/{id}', [
        'as' => 'owner.block',
        'uses' => 'OwnerController@blockOwner'
    ]);

    $router->get('/unblock/{id}', [
        'as' => 'owner.unblock',
        'uses' => 'OwnerController@unblockOwner'
    ]);

    $router->get('/active/{id}', [
        'as' => 'owner.active',
        'uses' => 'OwnerController@activeOwner'
    ]);

    $router->post('/delete/{id}', [
        'as' => 'owner.delete',
        'uses' => 'OwnerController@deleteOwner'
    ]);
  }
);