<?php

namespace App\Containers\ShippingUnit\Tasks;

use App\Containers\ShippingUnit\Data\Repositories\ShippingConstRepository;
use App\Containers\ShippingUnit\Data\Repositories\ShippingUnitRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteShippingConstTask extends Task
{

    protected $repository;

    public function __construct(ShippingConstRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->delete($id);
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
