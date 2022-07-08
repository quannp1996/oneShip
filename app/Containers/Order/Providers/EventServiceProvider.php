<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-21 14:45:44
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-11-21 16:36:06
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Providers;

use App\Containers\Order\Events\Admin\Events\DecreasePurchasedFlashsaleQuantityEvent;
use App\Containers\Order\Events\Admin\Events\IncreasePurchasedFlashsaleQuantityEvent;
use App\Containers\Order\Events\FrontEnd\Events\OrderSuccessEvent;
use App\Containers\Order\Events\Admin\Events\RollbackProductStockEvent;
use App\Containers\Order\Events\Admin\Events\SubtractionProductStockEvent;
use App\Containers\Order\Events\Admin\Events\OrderResendMailEvent;
use App\Containers\Order\Events\Admin\Events\SendOrderToShippingEvent;
use App\Containers\Order\Events\Admin\Events\UpdateCustomerRefRevenueEvent;
use App\Containers\Order\Events\Admin\Handlers\IncreaseProductPurchaseCountHanlder;
use App\Containers\Order\Events\FrontEnd\Handlers\OrderSendMailSuccessHandler;
use App\Containers\Order\Events\FrontEnd\Handlers\OrderSuccessPushNotiEventHandler;
use App\Containers\Order\Events\Admin\Handlers\UpdateStockProductByOrderHandler;
use App\Containers\Order\Events\FrontEnd\Events\OrderCancelEvent;
use App\Containers\Order\Events\FrontEnd\Handlers\OrderCancelPushNotiEventHandler;
use App\Containers\Order\Events\FrontEnd\Handlers\OrderSendMailCancelHandler;
use App\Containers\Order\Events\Admin\Handlers\OrderResendMailHandler;
use App\Containers\Order\Events\Admin\Handlers\OrderResendPushNotiEventHandler;
use App\Containers\Order\Events\Admin\Handlers\SendOrderToShippingEventHandler;
use App\Containers\Order\Events\Admin\Handlers\UpdatePurchasedFlashsaleQuantityHandler;
use App\Containers\Order\Events\FrontEnd\Handlers\DecreaseCouponCountHandler;
use App\Containers\Order\Events\Admin\Handlers\UpdateCustomerRefRevenueHandler;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // Admin
        SubtractionProductStockEvent::class => [
            UpdateStockProductByOrderHandler::class,
            IncreaseProductPurchaseCountHanlder::class
        ],
        RollbackProductStockEvent::class => [
            UpdateStockProductByOrderHandler::class
        ],
        OrderResendMailEvent::class => [
            OrderResendMailHandler::class,
            OrderResendPushNotiEventHandler::class
        ],
        DecreasePurchasedFlashsaleQuantityEvent::class => [
            UpdatePurchasedFlashsaleQuantityHandler::class
        ],
        IncreasePurchasedFlashsaleQuantityEvent::class=> [
            UpdatePurchasedFlashsaleQuantityHandler::class
        ],
        UpdateCustomerRefRevenueEvent::class=> [
            UpdateCustomerRefRevenueHandler::class
        ],
        // FrontEnd
        OrderSuccessEvent::class => [
            DecreaseCouponCountHandler::class,
            OrderSuccessPushNotiEventHandler::class,
            OrderSendMailSuccessHandler::class
        ],
        OrderCancelEvent::class => [
            OrderCancelPushNotiEventHandler::class,
            OrderSendMailCancelHandler::class
        ],
        SendOrderToShippingEvent::class => [
            SendOrderToShippingEventHandler::class
        ]
    ];

    public function boot() {
        parent::boot();
    }
}
