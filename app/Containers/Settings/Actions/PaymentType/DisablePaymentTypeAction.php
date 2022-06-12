<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-17 17:40:00
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-20 01:21:06
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Actions\PaymentType;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Settings\Models\PaymentType;
use App\Ship\Parents\Actions\Action;

class DisablePaymentTypeAction extends Action
{
    public function run(array $data)
    {
        $object = Apiato::call('Settings@PaymentType\DisablePaymentTypeTask', [$data['id']]);

        return $object;
    }
}
