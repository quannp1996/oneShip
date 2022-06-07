<?php

namespace App\Containers\ShippingUnit\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\ShippingUnit\Tasks\GetAllShippingUnitsTask;

class GetAllShippingUnitsAction extends Action
{
    public function run(array $condition = [])
    {
        $shippingunits = app(GetAllShippingUnitsTask::class)->filter($condition)->run();
        return $shippingunits;
    }


}
