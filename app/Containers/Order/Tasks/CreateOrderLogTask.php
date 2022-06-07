<?php

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Data\Repositories\OrderLogRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateOrderLogTask extends Task
{

    protected $repository;

    public function __construct(OrderLogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            return $this->repository->create($data);
        }
        catch (Exception $exception) {
            throw $exception;
        }
    }
}
