<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:40:00
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-18 13:25:10
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Actions\DeliveryType;

use App\Containers\Settings\Models\DeliveryType;
use App\Containers\Settings\Tasks\DeliveryType\FindDeliveryTypeByIdTask;
use App\Containers\Settings\Tasks\DeliveryType\GetAllDeliveryTypeDescTask;
use App\Containers\Settings\Tasks\DeliveryType\SaveDeliveryTypeDescTask;
use App\Containers\Settings\Tasks\DeliveryType\SaveDeliveryTypeTask;
use App\Ship\Parents\Actions\Action;

class UpdateDeliveryTypeAction extends Action
{
    public function run($data)
    {
        $beforeData = app(FindDeliveryTypeByIdTask::class)->run($data['id']);
        $object = app(SaveDeliveryTypeTask::class)->run($data);

        if ($object) {
            $original_desc = app(GetAllDeliveryTypeDescTask::class)->run($object->id);

            app(SaveDeliveryTypeDescTask::class)->run(
                $data,
                $original_desc,
                $object->id
            );
        }

        $this->clearCache();

        return $object;
    }
}
