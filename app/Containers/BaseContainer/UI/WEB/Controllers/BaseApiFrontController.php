<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-07 10:28:53
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-07 22:45:28
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\UI\WEB\Controllers;

use Apiato\Core\Foundation\Facades\FunctionLib;
use App\Containers\Localization\Actions\GetCurrentLangAction;
use App\Containers\Settings\Actions\GetAllSettingsAction;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;
use App\Ship\Parents\Controllers\ApiController;

class BaseApiFrontController extends ApiController
{
    use ApiResTrait;
    protected $settings = [];
    public $currentLang;
    public $user;
    protected $isMobile = false;

    public function __construct()
    {
        $this->currentLang = app(GetCurrentLangAction::class)->run();

        $this->settings = app(GetAllSettingsAction::class)->run('Array', true);

        $this->user = auth()->guard(config('auth.guard_for.api-customer'))->user();
        
        $this->isMobile = FunctionLib::isMobile($this->settings);
    }
}
