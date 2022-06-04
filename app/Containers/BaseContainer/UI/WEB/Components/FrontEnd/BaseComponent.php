<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-07-27 10:41:09
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-07 22:39:06
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\UI\WEB\Components\FrontEnd;

use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\Facades\FunctionLib;
use App\Containers\Settings\Actions\GetAllSettingsAction;
use App\Ship\Parents\Components\Component;

class BaseComponent extends Component
{
    protected $currentLang;
    protected $dataPassByMiddleware = [], $dataPassToView = [];
    public $isMobile = false;

    public function __construct()
    {
        $this->user = auth()->guard(config('auth.guard_for.frontend'))->user();
        $this->currentLang = Apiato::call('Localization@GetCurrentLangAction');
    }

    public function render()
    {
    }

    public function returnView(string $container, $view = null, string $subFolder = '', $data = [], $mergeData = [])
    {
        $viewPath = $container . '::' . ($subFolder ? $subFolder . '.' : '') . ($this->isMobile ? config('frontend-container.mobile_alias') : config('frontend-container.desktop_alias')) . '.' . $view;
        return view($viewPath, $data, array_merge($this->dataPassByMiddleware, $this->dataPassToView, $mergeData));
    }
}
