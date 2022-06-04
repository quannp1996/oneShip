<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-10 15:16:15
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-07 20:38:13
 * @ Description: Happy Coding!
 */

namespace App\Containers\Banner\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Banner\Tasks\BannerListingTask;
use App\Ship\Parents\Actions\Action;

class BannerListingAction extends Action
{
    public function run($filters, $limit = 10)
    {
        if (!empty($filters->position)) {
            $filters->positions = is_array($filters->position) ? implode(',', $filters->position) : $filters->position;
        }
        $defaultLanguage = Apiato::call('Localization@GetDefaultLanguageTask');
        $language_id = $defaultLanguage ? $defaultLanguage->language_id : 1;
        
        $data = app(BannerListingTask::class)->ordereByCreated();
        if (!empty($filters->name)) {
            $data->hasName($filters->name);
        }

        return $data->run($limit);
    }
}
