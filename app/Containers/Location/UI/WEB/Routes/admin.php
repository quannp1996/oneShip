<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'location',
        'namespace' => '\App\Containers\Location\UI\WEB\Controllers\Admin',
        'domain' => 'admin.' . parse_url(config('app.url'))['host'],
        'middleware' => [
            'auth:admin',
        ],
    ],
    function () use ($router){
        /**
         * City Router
         */
        $router->get('/city', [
            'as' => 'location.city_list',
            'uses' => 'CityController@listCity'
        ]);
        $router->post('/city/add', [
            'as' => 'location.city_add',
            'uses' => 'CityController@storeCity'
        ]);
        $router->post('/city/update/{id}', [
            'as' => 'location.city_update',
            'uses' => 'CityController@updateCity'
        ]);

        $router->post('/city/delete/{id}', [
            'as' => 'location.city_delete',
            'uses' => 'CityController@deleteCity'
        ]);
        $router->get('/city/ajax', [
            'as' => 'location.city_ajax',
            'uses' => 'CityController@getCityAjax'
        ]);
        /**
         * District Router
         */
        $router->get('/district', [
            'as' => 'location.district_list',
            'uses' => 'DistrictController@listDistrict'
        ]);
        $router->get('/district/ajax', [
            'as' => 'location.district_ajax',
            'uses' => 'DistrictController@getDistrictByCity'
        ]);
        $router->post('/district/add', [
            'as' => 'location.district_add',
            'uses' => 'DistrictController@storeDistrict'
        ]);
        $router->post('/district/update/{id}', [
            'as' => 'location.district_update',
            'uses' => 'DistrictController@updateDistrict'
        ]);
        $router->post('/district/delete/{id}', [
            'as' => 'location.district_delete',
            'uses' => 'DistrictController@deleteDistrict'
        ]);
        /**
         * Ward Router
         */
        $router->get('/ward', [
            'as' => 'location.ward_list',
            'uses' => 'WardController@listWard'
        ]);
        $router->get('/ward/ajax', [
            'as' => 'location.ward_ajax',
            'uses' => 'WardController@getWardByDistrict'
        ]);
        $router->post('/ward/add', [
            'as' => 'location.ward_add',
            'uses' => 'WardController@addWard'
        ]);
        $router->get('/ward/edit/{id}', [
            'as' => 'location.ward_edit',
            'uses' => 'WardController@editWard'
        ]);
        $router->post('/ward/delete', [
            'as' => 'location.ward_delete',
            'uses' => 'WardController@deleteWard'
        ]);
        $router->post('/ward/update/{id}', [
            'as' => 'location.ward_update',
            'uses' => 'WardController@updateWard'
        ]);

        $router->post('/import/city', [
            'as' => 'location.import.city',
            'uses' => 'ImportController@importCity'
        ]);
    }
);
?>