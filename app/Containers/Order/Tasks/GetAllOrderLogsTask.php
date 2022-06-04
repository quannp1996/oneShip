<?php

namespace App\Containers\Order\Tasks;

use App\Ship\Parents\Tasks\Task;
use App\Containers\Order\Data\Repositories\OrderLogRepository;
use App\Containers\Order\Data\Criterias\FilterOrderLogsCriteria;

class GetAllOrderLogsTask extends Task
{

    protected $repository;

    public function __construct(OrderLogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate(10);
    }

    public function filterOrderLogs($transporter) {
      $this->repository->pushCriteria(new FilterOrderLogsCriteria($transporter));
    }
} // End class
