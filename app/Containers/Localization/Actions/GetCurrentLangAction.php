<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-25 23:33:21
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 02:27:24
 * @ Description: Happy Coding!
 */

namespace App\Containers\Localization\Actions;

use App\Containers\Localization\Actions\SubActions\GetLangFromSegmentSubAction;
use App\Ship\Parents\Actions\Action;
use App\Containers\Localization\Models\Language;
use App\Containers\Localization\Tasks\GetLangByCodeTask;

class GetCurrentLangAction extends Action
{
    public function run(): ?Language
    {
        $segment = !empty($langDefault) ? $langDefault : \Request::segment(1);
        $segment2 = \Request::segment(2);

        return $this->remember(function() use($segment,$segment2) {
            $langFromSegment = app(GetLangFromSegmentSubAction::class)->run($segment,$segment2);
            $lang = app(GetLangByCodeTask:: class)->run($langFromSegment ? $langFromSegment : app()->getLocale());
            return $lang;
        },'current_lang_'.$segment.'_'.$segment2);
    }
}
