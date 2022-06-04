<?php

namespace App\Containers\ShippingUnit\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class UpdateShippingUnitAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        $shippingunit = Apiato::call('ShippingUnit@UpdateShippingUnitTask', [$request->id, $data]);

        return $shippingunit;
    }
}
