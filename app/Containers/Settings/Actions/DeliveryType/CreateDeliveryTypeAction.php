<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:40:00
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-18 12:38:07
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Actions\DeliveryType;

use App\Containers\Settings\Tasks\DeliveryType\CreateDeliveryTypeTask;
use App\Containers\Settings\Tasks\DeliveryType\FindDeliveryTypeByIdTask;
use App\Containers\Settings\Tasks\DeliveryType\SaveDeliveryTypeDescTask;
use App\Ship\Parents\Actions\Action;

class CreateDeliveryTypeAction extends Action
{
    public function run(array $data)
    {
        // dd($data);
        $object = app(CreateDeliveryTypeTask::class)->run($data);

        if ($object) {
            app(SaveDeliveryTypeDescTask::class)->run($data, [], $object->id);

            $object = app(FindDeliveryTypeByIdTask::class)->run($object->id);
            
        }

        $this->clearCache();

        return $object;
    }
}
