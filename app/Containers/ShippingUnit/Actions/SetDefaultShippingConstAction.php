<?php

namespace App\Containers\ShippingUnit\Actions;

use App\Containers\ShippingUnit\Tasks\FindShippingConstByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Containers\ShippingUnit\Tasks\SetDefaultShippingConstTask;

class SetDefaultShippingConstAction extends Action
{
    public function run($id)
    {
        $shippingconst = app(FindShippingConstByIdTask::class)->run($id);
        $shippingconst = app(SetDefaultShippingConstTask::class)->run($id, $shippingconst->shippingUnitID);
        return true;
    }
}
