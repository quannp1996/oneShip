<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-21 14:44:04
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-11-21 16:07:53
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Events\Admin\Handlers;

use App\Containers\BaseContainer\Events\Handlers\BaseFrontEventHandler;
use App\Containers\PromotionCampaign\Actions\Setters\UpdatePurchasedFlashsaleQuantityAction;

class UpdatePurchasedFlashsaleQuantityHandler extends BaseFrontEventHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    public function handle($event)
    {
        try{
            if (isset($event->order->orderItems) && !empty($event->order->orderItems)) {
                $arrProducts = [];
                foreach ($event->order->orderItems as $item) {
                    $arrProducts[$item->product_id] = isset($arrProducts[$item->product_id]) ? ($arrProducts[$item->product_id] + $item->quantity) : $item->quantity;
                }
    // dd($arrVariant);
                $action = app(UpdatePurchasedFlashsaleQuantityAction::class);
    
                isset($event->increase) ? ($event->increase ? $action->increase() : $action->decrease()) : false;
    
                $action->run($arrProducts);
            }
        }catch(\Exception $e) {
            throw $e;
        }
    }
}
