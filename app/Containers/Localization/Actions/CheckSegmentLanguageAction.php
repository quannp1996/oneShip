<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-25 23:31:45
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-20 16:41:45
 * @ Description: Happy Coding!
 */

namespace App\Containers\Localization\Actions;

use App\Containers\Localization\Actions\SubActions\GetLangFromSegmentSubAction;
use App\Ship\Parents\Actions\Action;

class CheckSegmentLanguageAction extends Action
{
    public function run($langDefault = '', $onlySegment = false): string
    {
        if(config('apiato.using_locale_segment')) {
            $segment = !empty($langDefault) ? $langDefault : \Request::segment(1);
            $segment2 = \Request::segment(3);

            // dd($segment,$segment2);
            // return $this->remember(function() use ($segment,$segment2,$langDefault,$onlySegment) {
                return app(GetLangFromSegmentSubAction::class)->run($segment,$segment2,$langDefault, $onlySegment);
            // },'segment_lang_'.$segment.'_'.$segment2);
        }else {
            return '';
        }
    }
}
