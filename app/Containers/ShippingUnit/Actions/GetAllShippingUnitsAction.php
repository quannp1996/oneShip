<?php

namespace App\Containers\ShippingUnit\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\ShippingUnit\Tasks\GetAllShippingUnitsTask;

class GetAllShippingUnitsAction extends Action
{
    protected bool $hasPagination = true;

    public function run(array $condition = [], array $withData = [])
    {
        return app(GetAllShippingUnitsTask::class)
                ->withData($withData)
                ->filter($condition)
                ->run($this->hasPagination);
    }
    public function setPagination(bool $hasPagination = false):self
    {
        $this->hasPagination = $hasPagination;
        return $this;
    }
}
