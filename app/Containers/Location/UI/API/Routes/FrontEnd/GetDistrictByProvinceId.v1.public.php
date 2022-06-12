<?php

use Apiato\Core\Foundation\Facades\Apiato;

Route::group(
[
    'middleware' => [
        'api',
    ],
    'prefix' => Apiato::call('Localization@CheckSegmentLanguageAction'),
],
function () use ($router) {
    $router->get('location/getDistrictByProvinceId', [
        'as' => 'api_location_get_district_by_province_id',
        'uses'       => 'FrontEnd\Controller@getDistrictByProvinceId'
    ]);
});