<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-21 14:44:04
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-24 16:47:03
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Events\Admin\Handlers;

use App\Containers\BaseContainer\Events\Handlers\BaseFrontEventHandler;
use App\Containers\Product\Actions\Product\UpdatePurchaseCountAction;

class IncreaseProductPurchaseCountHanlder extends BaseFrontEventHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    public function handle($event)
    {
        try{
            // dd($event->order->orderItems);
            if (isset($event->order->orderItems) && !empty($event->order->orderItems)) {
                $orderItems = $event->order->orderItems;
                $arrProduct = [];
                foreach ($orderItems as $item) {
                    $arrProduct[$item->product_id] = $item->quantity;
                }
                $action = app(UpdatePurchaseCountAction::class)->setProductPurchased($arrProduct)->increase();
    
                // isset($event->increase) ? ($event->increase ? $action->increase() : $action->decrease()) : false;
    
                $action->run();
            }
        }catch(\Exception $e) {
            throw $e;
        }
    }
}
