<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-25 23:33:21
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-01 01:31:06
 * @ Description: Happy Coding!
 */

namespace App\Containers\Localization\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\Localization\Models\Language;

class GetDefaultLanguageAction extends Action
{
    public function run(): ?Language
    {
        return $this->call('Localization@GetDefaultLanguageTask');
    }
}
