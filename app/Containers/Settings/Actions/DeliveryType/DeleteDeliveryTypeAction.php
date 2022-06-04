<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:40:00
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-18 13:15:51
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Actions\DeliveryType;

use App\Containers\DeliveryType\Models\DeliveryType;
use App\Containers\Settings\Tasks\DeliveryType\DeleteDeliveryTypeDescTask;
use App\Containers\Settings\Tasks\DeliveryType\DeleteDeliveryTypeTask;
use App\Ship\Parents\Actions\Action;

class DeleteDeliveryTypeAction extends Action
{
    public function run(array $data)
    {
        app(DeleteDeliveryTypeTask:: class)->run($data['id']);

        $this->clearCache();
        
    }
}
