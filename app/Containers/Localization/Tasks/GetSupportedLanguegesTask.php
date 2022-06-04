<?php
/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-25 23:34:01
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-07-25 23:41:42
 * @ Description: Happy Coding!
 */

namespace App\Containers\Localization\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Config;

class GetSupportedLanguegesTask extends Task
{
    public function run() :? array
    {
        return $this->remember(function () {
            $supported_locales = [];

            $locales = Config::get('localization-container.supported_languages');

            foreach ($locales as $key => $value) {
                // it is a "simple" language code (e.g., "en")!
                if (!is_array($value)) {
                    $supported_locales[] = $value;
                }

                // it is a combined language-code (e.g., "en-US")
                if (is_array($value)) {
                    foreach ($value as $k => $v) {
                        $supported_locales[] = $v;
                    }
                    $supported_locales[] = $key;
                }
            }

            return $supported_locales;
        });
    }
}
