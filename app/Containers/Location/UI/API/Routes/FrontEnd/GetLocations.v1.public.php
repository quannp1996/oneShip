<?php

use Illuminate\Support\Facades\Route;

Route::group(
[
    'middleware' => [
        'api',
    ],
    'prefix' => 'location',
],
function () use ($router) {
    $router->get('/provinces', [
        'as'    => 'api_fr_location_get_provinces',
        'uses'  => 'FrontEnd\Controller@getProvinces'
    ]);
    $router->get('/districts', [
        'as'    => 'api_fr_location_get_districts',
        'uses'  => 'FrontEnd\Controller@getDistricts'
    ]);
    $router->get('/wards', [
        'as'    => 'api_fr_location_get_wards',
        'uses'  => 'FrontEnd\Controller@getWards'
    ]);
});