<?php

namespace App\Containers\ShippingUnit\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllShippingUnitsAction extends Action
{
    public function run(Request $request)
    {
        $shippingunits = Apiato::call('ShippingUnit@GetAllShippingUnitsTask', [], ['addRequestCriteria']);

        return $shippingunits;
    }
}
