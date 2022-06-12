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
    $router->get('location/getGetWardByDistrictId', [
        'as' => 'api_location_get_ward_by_district_id',
        'uses'       => 'FrontEnd\Controller@getGetWardByDistrictId'
    ]);
});