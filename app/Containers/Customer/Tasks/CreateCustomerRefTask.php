<?php

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerRefRepository;
use App\Containers\Customer\Models\CustomerRef;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateCustomerRefTask extends Task
{

    protected $repository;

    public function __construct(CustomerRefRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($customerData) :? CustomerRef
    {
        try {
            return $this->repository->create($customerData);
        }
        catch (Exception $exception) {
            throw $exception;
        }
    }
}
