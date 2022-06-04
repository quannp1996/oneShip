<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:40:00
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 01:18:24
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Actions\PaymentType;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\PaymentType\Models\PaymentType;
use App\Containers\Settings\Tasks\PaymentType\CreatePaymentTypeTask;
use App\Containers\Settings\Tasks\PaymentType\FindPaymentTypeByIdTask;
use App\Containers\Settings\Tasks\PaymentType\SavePaymentTypeDescTask;
use App\Ship\Parents\Actions\Action;

class CreatePaymentTypeAction extends Action
{
    public function run(array $data)
    {
        // dd($data);
        $object = app(CreatePaymentTypeTask::class)->run($data);

        if ($object) {
            app(SavePaymentTypeDescTask::class)->run($data, [], $object->id);

            $object = app(FindPaymentTypeByIdTask::class)->run($object->id);
        }

        $this->clearCache();

        return $object;
    }
}
