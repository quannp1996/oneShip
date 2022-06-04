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
use Illuminate\Support\Facades\Route;

Route::group(
[
    'middleware' => [
        'auth:api-customer'
    ],
    'prefix' => Apiato::call('Localization@CheckSegmentLanguageAction').'/customer',
],
function () use ($router) {
    $router->any('/editCustomerInfor', [
        'as' => 'api_edit_customer_infor',
        'uses'       => 'FrontEnd\Controller@editCustomerInfor'
    ]);

    $router->any('/me/updateCustomerInfor', [
        'as' => 'api_update_customer_infor',
        'uses'       => 'FrontEnd\Controller@updateCustomerInfor'
    ]);

    $router->any('/me/updatePassword', [
        'as' => 'api_update_customer_password',
        'uses'       => 'FrontEnd\Controller@updatePassword'
    ]);

    $router->post('/me/updateAvatar', [
        'as' => 'api_update_customer_avatar',
        'uses'       => 'FrontEnd\Controller@updateAvatar'
    ]);

    $router->any('/me', [
        'as' => 'api_get_customer_infor',
        'uses'       => 'FrontEnd\Controller@getCustomerInfor'
    ]);

    $router->any('/me/addressbook', [
        'as' => 'api_get_customer_address_book',
        'uses'       => 'FrontEnd\Controller@getCustomerAddressBook'
    ]);

    $router->post('/me/addressbook/newAddress', [
        'as' => 'api_new_customer_address_book',
        'uses'       => 'FrontEnd\Controller@newAddress'
    ]);

    $router->post('/me/addressbook/updateAddress', [
        'as' => 'api_update_customer_address_book',
        'uses'       => 'FrontEnd\Controller@updateAddress'
    ]);

});