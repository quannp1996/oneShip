<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-25 23:31:45
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-20 16:43:07
 * @ Description: Happy Coding!
 */

namespace App\Containers\Localization\Actions\SubActions;

use App\Containers\Localization\Tasks\GetSupportedLanguegesTask;
use App\Ship\Parents\Actions\SubAction;

class GetLangFromSegmentSubAction extends SubAction
{
    public $getSupportedLanguegesTask;
    public function __construct(GetSupportedLanguegesTask $getSupportedLanguegesTask)
    {
        $this->getSupportedLanguegesTask = $getSupportedLanguegesTask;
        parent::__construct();
    }

    public function run($segment = '',$segment2 = '',$langDefault = '', $onlySegment = false): string
    {
        $langCode = config('app.locale');

        if (config('apiato.using_locale_segment')) {
            $segment = !empty($langDefault) ? $langDefault : $segment;
            $supported_languages = $this->getSupportedLanguegesTask->run();

            if (in_array($segment, $supported_languages)) {
                $langCode = $segment;
            } elseif (in_array($segment2, $supported_languages)) {
                $langCode = $segment2;
            }

            // dd($langCode,config('app.locale'));
            // if(empty($langCode) && $onlySegment == false) {
            //     $default = config('app.locale');
            //     $langCode = FunctionLib::getCookie(FunctionLib::getLanguageKey(), $default,true,false);
            //     $langCode = explode('|',$langCode);
            // }

            $langCode = is_array($langCode) ? (count($langCode) > 1 ? $langCode[1] : $langCode[0]) : $langCode;
        }

        if ($langCode) {
            app()->setLocale($langCode);
        }
        // dump(app()->getLocale());
        // dd($langCode,config('app.locale'));
        return config('apiato.using_locale_segment') ? $langCode : '';
    }
}
