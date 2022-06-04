<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:40:00
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 01:19:08
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Actions\PaymentType;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\PaymentType\Models\PaymentType;
use App\Ship\Parents\Actions\Action;

class EnablePaymentTypeAction extends Action
{

    public function run(array $data)
    {
        $object = Apiato::call('Settings@PaymentType\EnablePaymentTypeTask', [$data['id']]);
        
        $this->clearCache();

        return $object;
    }
}
