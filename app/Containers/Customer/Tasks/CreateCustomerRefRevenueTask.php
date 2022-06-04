<?php

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerRefRevenueRepository;
use App\Containers\Customer\Models\CustomerRef;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateCustomerRefRevenueTask extends Task
{

    protected $repository;

    public function __construct(CustomerRefRevenueRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($customerData)
    {
        try {
            return $this->repository->create($customerData);
        }
        catch (Exception $exception) {
            throw $exception;
        }
    }
}
