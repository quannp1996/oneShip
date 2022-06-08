<?php

namespace App\Containers\ShippingUnit\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindShippingUnitByIdAction extends Action
{
    public function run($id)
    {
        $shippingunit = Apiato::call('ShippingUnit@FindShippingUnitByIdTask', [$id]);
        return $shippingunit;
    }
}
