<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-21 14:44:04
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-11-21 16:41:40
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Events\FrontEnd\Handlers;

use App\Containers\BaseContainer\Events\Handlers\BaseFrontEventHandler;
use App\Containers\Discount\Actions\Getters\GetCodeByCodeAction;

class DecreaseCouponCountHandler extends BaseFrontEventHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    public function handle($event)
    {
        try{
            if (isset($event->order->coupon_code) && !empty($event->order->coupon_code)) {
                $code = app(GetCodeByCodeAction::class)->run($event->order->coupon_code);

                if(!empty($code) && $code->quantity > 0) {
                    $code->quantity = $code->quantity - 1;
                    $code->use_success = $code->use_success + 1;
                    $code->save();
                }
            }
        }catch(\Exception $e) {
            throw $e;
        }
    }
}
