<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-06-23 21:08:24
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-05 12:08:11
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Localization\Models\Language;

class GetAllSettingsAction extends SettingsParentAction
{
    public function run($dataReturnType = 'Eloquent', $skipPaginate = false, ?Language $currentLang = null)
    {
        $locale = $currentLang->language_id ?? '';
        return $this->remember(function () use ($dataReturnType, $skipPaginate, $locale) {
            $settings = Apiato::call('Settings@GetAllSettingsTask', [$skipPaginate], ['addRequestCriteria', 'ordered']);
            $returnArray = [];
            if ($settings && !$settings->isEmpty() && $dataReturnType == 'Array') {
                // $settings = $settings->keyBy('key')->toArray();

                foreach ($settings as $item) {
                    $returnArray[$item->key] = json_decode($item->value, true);
                }
            }

            //== handle cho cấu hình đa ngôn ngữ key website
            if (isset($returnArray['website' . $locale])) {
                $returnArray['website'] = array_merge($returnArray['website'], $returnArray['website' . $locale]);
            }
            //

            return $returnArray;
        }, 'settings' . $locale);
    }
}
