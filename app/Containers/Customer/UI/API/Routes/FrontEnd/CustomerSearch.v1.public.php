<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-24 13:35:18
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-19 21:37:10
 * @ Description: Happy Coding!
 */

use Apiato\Core\Foundation\Facades\Apiato;

Route::group(
[
    'middleware' => [
        // 'auth:api-customer'
    ],
    'prefix' => Apiato::call('Localization@CheckSegmentLanguageAction').'/customer',
],
function () use ($router) {
    $router->get('/customerSearch', [
        'as' => 'api_customer_history_search',
        'uses'       => 'FrontEnd\Controller@getHistorySearch'
    ]);
    
    $router->post('/saveCustomerRef', [
        'as' => 'api_save_customer_ref',
        'uses'       => 'FrontEnd\Controller@saveCustomerRef'
    ]);
});