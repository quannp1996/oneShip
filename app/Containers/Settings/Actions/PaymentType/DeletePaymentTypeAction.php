<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:40:00
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 01:22:52
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Actions\PaymentType;

use App\Containers\PaymentType\Models\PaymentType;
use App\Containers\Settings\Tasks\PaymentType\DeletePaymentTypeDescTask;
use App\Containers\Settings\Tasks\PaymentType\DeletePaymentTypeTask;
use App\Ship\Parents\Actions\Action;

class DeletePaymentTypeAction extends Action
{
    public function run(array $data)
    {
        app(DeletePaymentTypeTask:: class)->run($data['id']);

        $this->clearCache();

    }
}
