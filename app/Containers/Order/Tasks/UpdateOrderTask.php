<?php

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Data\Repositories\OrderRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateOrderTask extends Task
{

    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
          $data['is_need_resync'] = 1 ;
          return $this->repository->update($data, $id);
        }
        catch (Exception $exception) {
            throw $exception;
        }
    }
}
