<?php

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Data\Repositories\OrderRepository;
use App\Ship\Parents\Tasks\Task;

class GetNumberOfOrderByStatusTask extends Task
{

    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(string $whereString="")
    {
      return $this->repository->whereRaw($whereString)->count('id');
    }
}
