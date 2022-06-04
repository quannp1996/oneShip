<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-11-21 20:07:37
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-11-21 20:09:39
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Actions\Getters;

use App\Containers\Order\Tasks\Getters\GetCouponUsedOnOrderTask;
use App\Ship\Parents\Actions\Action;

class GetCouponUsedOnOrderAction extends Action
{
    public function run(int $customerId,string $couponCode)
    {
        return app(GetCouponUsedOnOrderTask::class)->customerId($customerId)->couponCode($couponCode)->run();
    }
}
