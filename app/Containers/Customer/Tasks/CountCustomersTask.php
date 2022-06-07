<?php

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Arr;

class CountCustomersTask extends Task
{

    protected $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(): int
    {
        try {
            return $this->repository->count([
                ['is_contractor', '=', 0]
            ]);
        }
        catch (Exception $exception) {
            throw $exception;
        }
    }
}
