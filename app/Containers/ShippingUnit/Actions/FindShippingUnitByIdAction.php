<?php

namespace App\Containers\ShippingUnit\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindShippingUnitByIdAction extends Action
{
    public function run(Request $request)
    {
        $shippingunit = Apiato::call('ShippingUnit@FindShippingUnitByIdTask', [$request->id]);

        return $shippingunit;
    }
}
