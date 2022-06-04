<?php

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindCustomerByIdTask extends Task
{

    protected $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $with=[])
    {
        try {
            return $this->repository->with($with)->find($id);
        }
        catch (Exception $exception) {
            throw $exception;
        }
    }

    public function withCount(array $withCount = []){

        if(!empty($withCount)) $this->repository->withCount($withCount);
    }
}
