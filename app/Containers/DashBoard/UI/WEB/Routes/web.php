<?php

$router->get('/dashboard', [
    'as'   => 'get_admin_dashboard_page',
    'uses'       => '\App\Containers\DashBoard\UI\WEB\Controllers\Admin\Controller@viewDashboardPage',
    'domain' => config('app.admin_url'),
    'middleware' => [
        'auth:admin'
    ],
]);

$router->get('/dashboard/orders-statistic', [
  'as'   => 'admin.dashboard.orders-statistic',
  'uses'       => '\App\Containers\DashBoard\UI\WEB\Controllers\Admin\Controller@ordersStatistic',
  'domain' => config('app.admin_url'),
  'middleware' => [
      'auth:admin'
  ],
]);

$router->get('/dashboard/revenue', [
  'as'   => 'admin.dashboard.revenue',
  'uses'       => '\App\Containers\DashBoard\UI\WEB\Controllers\Admin\Controller@revenueStatistic',
  'domain' => config('app.admin_url'),
  'middleware' => [
      'auth:admin'
  ],
]);

$router->get('dashboard/top-products', [
  'as'   => 'admin.dashboard.top-products',
  'uses'       => '\App\Containers\DashBoard\UI\WEB\Controllers\Admin\Controller@topProductsStatistic',
  'domain' => config('app.admin_url'),
  'middleware' => [
      'auth:admin'
  ],
]);

$router->get('dashboard/code-statistic', [
  'as'   => 'admin.dashboard.code-statistic',
  'uses'       => '\App\Containers\DashBoard\UI\WEB\Controllers\Admin\Controller@discountCodeStatistic',
  'domain' => config('app.admin_url'),
  'middleware' => [
      'auth:admin'
  ],
]);

$router->get('dashboard/purchased-ability', [
  'as'   => 'admin.dashboard.purchased-ability',
  'uses'       => '\App\Containers\DashBoard\UI\WEB\Controllers\Admin\Controller@purchasedAbilityStatistic',
  'domain' => config('app.admin_url'),
  'middleware' => [
      'auth:admin'
  ],
]);

$router->get('dashboard/product/{productId}', [
  'as'   => 'admin.dashboard.product-single',
  'uses'       => '\App\Containers\DashBoard\UI\WEB\Controllers\Admin\Controller@getProductSingleStatistic',
  'domain' => config('app.admin_url'),
  'middleware' => [
      'auth:admin'
  ],
])->where(['productId' => '[0-9]+']);

$router->get('/dashboard/thongke', [
  'as'   => 'admin.dashboard.thongke',
  'uses'       => '\App\Containers\DashBoard\UI\WEB\Controllers\Admin\Controller@thongke',
  'domain' => config('app.admin_url'),
  'middleware' => [
      'auth:admin'
  ],
]);
