<?php

namespace App\Containers\ShippingUnit\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteShippingUnitAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('ShippingUnit@DeleteShippingUnitTask', [$request->id]);
    }
}
