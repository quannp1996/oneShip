<?php

$router->post('/common/render-item', [
  'as'   => 'admin.customers.renderItem',
  'uses' => 'Controller@renderItem',
  'middleware' => [
    'cors'
  ]
]);

$router->get('/clear-cache', function() {
  $exitCode = \Illuminate\Support\Facades\Artisan::call('cache:clear');
  // return what you want
  echo $exitCode;
  echo 'Clear Done!';
})->name('clear_cache');

//Clear Config cache:
$router->get('/config-cache', function() {
  $exitCode = \Illuminate\Support\Facades\Artisan::call('config:cache');
  return '<h1>Clear Config cleared</h1>';
})->name('config_cache');

$router->get('/route-clear', function() {
  $exitCode = \Illuminate\Support\Facades\Artisan::call('route:clear');
  return '<h1>Route cleared</h1>';
})->name('clear_route');
$router->get('/clear-compiled', function() {
  $exitCode = \Illuminate\Support\Facades\Artisan::call('clear-compiled');
  return '<h1>Clear Compiled</h1>';
})->name('clear_compiled');
$router->get('/clear-view', function() {
  $exitCode = \Illuminate\Support\Facades\Artisan::call('view:clear');
  return '<h1>Complete Cleaning View</h1>';
})->name('clear_view');