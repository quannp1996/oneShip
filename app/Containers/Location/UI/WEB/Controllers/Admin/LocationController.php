<?php

namespace App\Containers\Location\UI\WEB\Controllers\Admin;

use App\Containers\BaseContainer\Enums\BaseEnum;
use App\Containers\ShippingUnit\Actions\GetAllShippingUnitsAction;
use App\Ship\Parents\Controllers\AdminController;

/**
 * Class Controller
 *
 * @package App\Containers\Location\UI\WEB\Controllers
 */
class LocationController extends AdminController
{
    
    public function __construct()
    {
        $this->title = __('location::admin.city.title');
        $allShippings = app(GetAllShippingUnitsAction::class)->run([
            'status' => BaseEnum::ACTIVE
        ]);
        view()->share('allShippings', $allShippings);
        parent::__construct();
    }
}
