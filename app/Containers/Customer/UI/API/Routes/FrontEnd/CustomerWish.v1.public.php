<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-24 13:35:18
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-19 21:37:10
 * @ Description: Happy Coding!
 */

use Apiato\Core\Foundation\Facades\Apiato;

Route::group(
[
    'middleware' => [
        'auth:api-customer'
    ],
    'prefix' => Apiato::call('Localization@CheckSegmentLanguageAction').'/customer',
],
function () use ($router) {
    $router->put('/addWishList', [
        'as' => 'api_product_add_wish_list',
        'uses'       => 'FrontEnd\Controller@addWishList'
    ]);
    
    $router->get('/wishlist', [
        'as' => 'api_get_wish_list',
        'uses'       => 'FrontEnd\Controller@getAllWishList'
    ]);
});