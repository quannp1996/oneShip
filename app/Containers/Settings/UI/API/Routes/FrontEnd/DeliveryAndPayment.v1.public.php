<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-04 16:55:35
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-20 02:45:16
 * @ Description: Happy Coding!
 */

use App\Containers\Localization\Actions\CheckSegmentLanguageAction;

Route::group(
[
    'middleware' => [
        // 'api',
    ],
    'prefix' => app(CheckSegmentLanguageAction::class)->run().'/payAndDeliMethods',
],
function () use ($router) {
    // Lấy về danh sách phương thức thanh toán và vận chuyển
    $router->any('/', [
        'as' => 'api_get_setting_pay_deli_methods',
        'uses'       => 'FrontEnd\DeliveryAndPayment\Controller@getPayAndDeliMethods'
    ]);
});