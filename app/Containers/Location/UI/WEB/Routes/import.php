<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'location',
        'namespace' => '\App\Containers\Location\UI\WEB\Controllers\Admin',
        'domain' => config('admin_url'),
        'middleware' => [
            'auth:admin',
        ],
    ],
    function () use ($router){
        $router->post('/import/city', [
            'as' => 'location.import.city',
            'uses' => 'ImportController@importCity'
        ]);
        $router->post('/import/district', [
            'as' => 'location.import.district',
            'uses' => 'ImportController@importDistrict'
        ]);
        $router->post('/import/ward', [
            'as' => 'location.import.ward',
            'uses' => 'ImportController@importWard'
        ]);
    }
);
?>