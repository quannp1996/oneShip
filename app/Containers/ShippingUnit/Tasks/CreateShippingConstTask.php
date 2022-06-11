<?php

namespace App\Containers\ShippingUnit\Tasks;

use Exception;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\ShippingUnit\Data\Repositories\ShippingConstRepository;


class CreateShippingConstTask extends Task
{

    protected $repository;

    public function __construct(ShippingConstRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            return $this->repository->create($data);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
