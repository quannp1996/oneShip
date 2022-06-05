<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-21 14:44:04
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-11-21 16:06:09
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Events\Admin\Handlers;

use App\Containers\BaseContainer\Events\Handlers\BaseFrontEventHandler;
use App\Containers\Product\Actions\ProductVariant\UpdateStockByVariantIdAction;

class UpdateStockProductByOrderHandler extends BaseFrontEventHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    public function handle($event)
    {
        try{
            if (isset($event->order->orderItems) && !empty($event->order->orderItems)) {
                $arrVariant = [];
                foreach ($event->order->orderItems as $item) {
                    $arrVariant[$item->variant_id] = $item->quantity;
                }
    // dd($arrVariant);
                $action = app(UpdateStockByVariantIdAction::class)->setVariantStock($arrVariant);
    
                isset($event->increase) ? ($event->increase ? $action->increase() : $action->decrease()) : false;
    
                $action->run();
            }
        }catch(\Exception $e) {
            throw $e;
        }
    }
}
