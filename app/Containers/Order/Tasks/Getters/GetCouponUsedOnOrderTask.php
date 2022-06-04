<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-11-21 19:55:49
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-11-21 20:07:26
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Tasks\Getters;

use App\Containers\Order\Data\Repositories\OrderRepository;
use App\Ship\Parents\Tasks\Task;

class GetCouponUsedOnOrderTask extends Task
{
    protected $repository;
    protected $customerId, $couponCode;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(): bool
    {
        if(!empty($this->customerId) && !empty($this->couponCode)) {
            return $this->repository->where('customer_id',$this->customerId)->where('coupon_code',$this->couponCode)->exists();
        }

        return false;
    }

    public function customerId(int $customerId): self
    {
        $this->customerId = $customerId;
        return $this;
    }

    public function couponCode(string $couponCode): self
    {
        $this->couponCode = $couponCode;
        return $this;
    }
}
