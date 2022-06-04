<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-22 00:50:39
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-22 12:32:23
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Traits;

use App\Containers\Customer\Models\Customer;

trait OrderCustomerTrait
{
    public function customer() {
        return $this->hasOne(Customer::class,'id','customer_id');
    }
}
