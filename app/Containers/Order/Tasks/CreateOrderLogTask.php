<?php

namespace App\Containers\Order\Tasks;

use Exception;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Order\Data\Repositories\OrderLogRepository;

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
