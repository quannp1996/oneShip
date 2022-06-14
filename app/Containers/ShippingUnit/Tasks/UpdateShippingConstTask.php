<?php

namespace App\Containers\ShippingUnit\Tasks;

use App\Containers\ShippingUnit\Data\Repositories\ShippingConstRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateShippingConstTask extends Task
{

    protected $repository;

    public function __construct(ShippingConstRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
