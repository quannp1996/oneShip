<?php

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerRepository;
use App\Containers\Customer\Models\Customer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Arr;

class CreateCustomerTask extends Task
{

    protected $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($customerData) :? Customer
    {
        try {
            return $this->repository->create($customerData);
        }
        catch (Exception $exception) {
            throw $exception;
        }
    }
}
