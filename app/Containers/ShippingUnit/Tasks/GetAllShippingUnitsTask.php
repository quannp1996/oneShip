<?php

namespace App\Containers\ShippingUnit\Tasks;

use App\Containers\ShippingUnit\Data\Repositories\ShippingUnitRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllShippingUnitsTask extends Task
{

    protected $repository;

    public function __construct(ShippingUnitRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }
}
