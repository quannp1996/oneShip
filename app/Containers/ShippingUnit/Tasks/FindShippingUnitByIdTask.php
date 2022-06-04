<?php

namespace App\Containers\ShippingUnit\Tasks;

use App\Containers\ShippingUnit\Data\Repositories\ShippingUnitRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindShippingUnitByIdTask extends Task
{

    protected $repository;

    public function __construct(ShippingUnitRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
