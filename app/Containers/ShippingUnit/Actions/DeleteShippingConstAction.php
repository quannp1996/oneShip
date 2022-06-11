<?php

namespace App\Containers\ShippingUnit\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\ShippingUnit\Tasks\DeleteShippingConstTask;

class DeleteShippingConstAction extends Action
{
    public function run($id)
    {
        app(DeleteShippingConstTask::class)->run($id);
        return true;
    }
}
