<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:40:00
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-18 12:14:32
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Actions\DeliveryType;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class FindDeliveryTypeByIdAction extends Action
{
    public function run($banner_id)
    {
        $data = Apiato::call('Settings@DeliveryType\FindDeliveryTypeByIdTask', [
            $banner_id,
            Apiato::call('Localization@GetDefaultLanguageTask'),
            ['with_relationship' => ['all_desc']]
        ]);

//        if ($data) {
//            $data->setRelation('all_desc', $data->all_desc->keyBy('language_id'));
//        }

        return $data;
    }
}
