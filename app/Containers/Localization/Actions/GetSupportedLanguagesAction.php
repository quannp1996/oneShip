<?php
/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-25 23:33:21
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-07-25 23:41:45
 * @ Description: Happy Coding!
 */

namespace App\Containers\Localization\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class GetSupportedLanguagesAction extends Action
{
    public function run(): array
    {
        return Apiato::call('Localization@GetSupportedLanguegesTask');
    }
}
