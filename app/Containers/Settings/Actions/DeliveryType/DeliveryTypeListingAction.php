<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:40:00
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 02:58:44
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Actions\DeliveryType;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Localization\Models\Language;
use App\Containers\Settings\Tasks\DeliveryType\DeliveryTypeListingTask;
use App\Ship\Parents\Actions\Action;

class DeliveryTypeListingAction extends Action
{
    public function run(array $filters, ?Language $currentLang, int $limit = 10,bool $skipPagin = false)
    {
        $language_id = $currentLang ? $currentLang->language_id : 1;

        $data = app(DeliveryTypeListingTask::class)->filters($filters)->ordereBySort()->withDescription($language_id);

        if (!empty($filters['name'])) {
            $data->hasName($filters['name']);
        }

        return $data->run($skipPagin,$limit);
    }
}
