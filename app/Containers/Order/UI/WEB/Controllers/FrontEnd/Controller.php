<?php

namespace App\Containers\Order\UI\WEB\Controllers\FrontEnd;

use App\Containers\BaseContainer\UI\WEB\Controllers\NeedAuthController;
use App\Containers\Order\UI\WEB\Requests\FrontEnd\StoreOrderRequest;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;

/**
 * Class Controller
 *
 * @package App\Containers\Order\UI\WEB\Controllers\FrontEnd
 */
class Controller extends NeedAuthController
{
    use ApiResTrait;
    public function apiList()
    {

    }

    public function apiStore(StoreOrderRequest $request)
    {
        dd($this->settings);
    }
}
