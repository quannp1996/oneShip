<?php

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerFollowRepository;
use Exception;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Customer\Models\Customer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Containers\Customer\Data\Repositories\CustomerRepository;

class AttachFollowContractorTask extends Task
{

    protected $repository;

    public function __construct(CustomerFollowRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $followData=[])
    {
        try {
            return $this->repository->create($followData);
        }
        catch (Exception $exception) {
            dd($exception->getMessage());
            throw new CreateResourceFailedException();
        }
    }
}
