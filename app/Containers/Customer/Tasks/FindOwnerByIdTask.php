<?php

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindOwnerByIdTask extends Task
{

    protected $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->where([
                'is_contractor' => 0,
                'id' => $id
            ])->first();
        }
        catch (Exception $exception) {
            throw $exception;
        }
    }

    public function withCount(array $withCount = []){

        if(!empty($withCount)) $this->repository->withCount($withCount);
    }

    public function withData(array $withData = []){

        if(!empty($withData)) $this->repository->with($withData);
    }
}
