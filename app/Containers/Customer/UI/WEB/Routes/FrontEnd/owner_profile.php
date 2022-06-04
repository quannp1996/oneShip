<?php
Route::group(
  [
      'prefix' => 'owner',
      'namespace' => '\App\Containers\Customer\UI\WEB\Controllers\Desktop',
      'domain' => parse_url(config('app.url'))['host'],
  ],
  function () use ($router) {

    $router->get('/profile', [
        'as' => 'get_owner_profile_page',
        'uses' => 'CustomerProfileController@showProfile',
        'middleware' => [
          'auth_owner',
      ],
    ]);

    $router->post('/profile/update', [
      'as' => 'update_owner_profile',
      'uses' => 'CustomerProfileController@updateProfile',
      'middleware' => [
        'auth_owner',
      ],
    ]);

    $router->post('/profile/changepassword', [
      'as' => 'change_password_owner',
      'uses' => 'CustomerProfileController@changePassword',
      'middleware' => [
        'auth_owner',
      ],
    ]);

    $router->post('/update/avatar', [
      'as' => 'update_owner_avatar',
      'uses' => 'CustomerProfileController@updateAvatar',
      'middleware' => [
        'auth_owner',
      ],
    ]);

    $router->post('/sendcode', [
      'as' => 'update_owner_avatar',
      'uses' => 'CustomerProfileController@sendOtpCode',
      'middleware' => [
        'auth_owner',
      ],
    ]);

    $router->post('/checkcode', [
      'as' => 'update_owner_avatar',
      'uses' => 'CustomerProfileController@checkCode',
      'middleware' => [
        'auth_owner',
      ],
    ]);

    $router->post('/setup/method', [
      'as' => 'setup_method_otp_owner',
      'uses' => 'CustomerProfileController@setupMethod',
      'middleware' => [
        'auth_owner',
      ],
    ]);

    $router->get('/ajax-owner-list', [
      'as' => 'owner.get_more_owner_building',
      'uses' => 'CustomerProfileController@ajaxOwnerList',
      'middleware' => [
        'auth_owner',
      ],
    ]);
  }
);

