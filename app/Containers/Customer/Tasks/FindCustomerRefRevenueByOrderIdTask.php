<?php

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerRefRevenueRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindCustomerRefRevenueByOrderIdTask extends Task
{

    protected $repository;

    public function __construct(CustomerRefRevenueRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($order_id)
    {
        try {
            return $this->repository->where('order_id',$order_id)->first();
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
