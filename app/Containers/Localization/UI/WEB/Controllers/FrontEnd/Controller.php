<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-29 14:37:42
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-29 14:58:12
 * @ Description: Happy Coding!
 */

namespace App\Containers\Localization\UI\WEB\Controllers\FrontEnd;

use App\Containers\BaseContainer\UI\WEB\Controllers\BaseFrontEndController;

class Controller extends BaseFrontEndController
{
    public function getJsonI18n()
    {

        if (request()->remove_cache == 1) {
            \Cache::forget('i18n.' . $this->currentLang->short_code . '.js');
        }

        $strings = \Cache::rememberForever('i18n.' . $this->currentLang->short_code . '.js', function () {

            $files   = glob(resource_path('lang/' . $this->currentLang->short_code . '/*.php'));
            $strings = [];

            foreach ($files as $file) {
                $name           = basename($file, '.php');
                $strings[$name] = require $file;
            }

            return $strings;
        });

        header('Content-Type: text/javascript');
        echo ('window.i18n = ' . json_encode($strings) . ';');
        exit();
    }
}
