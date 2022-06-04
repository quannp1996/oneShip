<?php

namespace App\Containers\Customer\Tasks;

use Exception;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Exceptions\NotFoundException;
use App\Containers\Customer\Data\Repositories\CustomerRepository;

class FindOneCustomerByConditionTask extends Task
{

    protected $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $condition = [])
    {
        try {
            return $this->repository->where($condition)->first();
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
