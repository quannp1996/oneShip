<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-24 13:35:18
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-11-17 14:42:32
 * @ Description: Happy Coding!
 */

use App\Containers\Localization\Actions\CheckSegmentLanguageAction;

Route::group(
    [
        'middleware' => [
            'auth:api-customer'
        ],
        'prefix' => app(CheckSegmentLanguageAction::class)->run() . '/order',
    ],
    function () use ($router) {
        $router->get('/orderList', [
            'as' => 'api_list_order_customer',
            'uses' => 'FrontEnd\Controller@orderList'
        ]);

        $router->get('/orderDetail', [
            'as' => 'api_detail_order_customer',
            'uses' => 'FrontEnd\Controller@orderDetail'
        ]);
        // ->where([
        //     'token_tracking' => '[a-zA-Z0-9_\-]+',
        // ]);

        $router->post('/saveOrder', [
            'as' => 'api_save_order_infor',
            'uses' => 'FrontEnd\Controller@saveOrder'
        ]);

        $router->post('/cancelOrder', [
            'as' => 'api_cancel_order',
            'uses' => 'FrontEnd\Controller@cancelOrder'
        ]);

        $router->post('/buyOrderAgain',[
            'as' => 'api_buy_order_again',
            'uses' => 'FrontEnd\Controller@buyOrderAgain'
        ]);
    }
);
