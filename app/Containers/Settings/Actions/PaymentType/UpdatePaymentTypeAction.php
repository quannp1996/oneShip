<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:40:00
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 01:19:38
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Actions\PaymentType;

use App\Containers\Settings\Models\PaymentType;
use App\Containers\Settings\Tasks\PaymentType\FindPaymentTypeByIdTask;
use App\Containers\Settings\Tasks\PaymentType\GetAllPaymentTypeDescTask;
use App\Containers\Settings\Tasks\PaymentType\SavePaymentTypeDescTask;
use App\Containers\Settings\Tasks\PaymentType\SavePaymentTypeTask;
use App\Ship\Parents\Actions\Action;

class UpdatePaymentTypeAction extends Action
{
    public function run($data)
    {
        $beforeData = app(FindPaymentTypeByIdTask::class)->run($data['id']);
        $object = app(SavePaymentTypeTask::class)->run($data);

        if ($object) {
            $original_desc = app(GetAllPaymentTypeDescTask::class)->run($object->id);

            app(SavePaymentTypeDescTask::class)->run(
                $data,
                $original_desc,
                $object->id
            );

        }

        $this->clearCache();

        return $object;
    }
}
