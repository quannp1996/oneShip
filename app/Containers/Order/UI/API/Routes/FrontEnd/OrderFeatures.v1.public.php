<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-24 13:35:18
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-11-17 14:42:32
 * @ Description: Happy Coding!
 */

use Illuminate\Support\Facades\Route;
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
