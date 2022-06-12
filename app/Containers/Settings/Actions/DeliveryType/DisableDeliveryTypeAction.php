<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-17 17:40:00
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-17 18:17:20
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Actions\DeliveryType;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Settings\Models\DeliveryType;
use App\Ship\Parents\Actions\Action;

class DisableDeliveryTypeAction extends Action
{
    public function run(array $data)
    {
        $object = Apiato::call('Settings@DeliveryType\DisableDeliveryTypeTask', [$data['id']]);

        return $object;
    }
}
