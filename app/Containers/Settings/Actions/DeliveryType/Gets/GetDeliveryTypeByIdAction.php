<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:40:00
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-19 17:01:21
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Actions\DeliveryType\Gets;

use App\Containers\Localization\Models\Language;
use App\Containers\Settings\Tasks\DeliveryType\FindDeliveryTypeByIdTask;
use App\Ship\Parents\Actions\Action;

class GetDeliveryTypeByIdAction extends Action
{
    public function run($id, ?Language $currentLang)
    {
        $data = app(FindDeliveryTypeByIdTask::class)
        ->currentLang($currentLang)
        ->withDescription()
        ->run($id);

        return $data;
    }
}
