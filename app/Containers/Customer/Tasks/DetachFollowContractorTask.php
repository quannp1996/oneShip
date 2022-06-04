<?php

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerFollowRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DetachFollowContractorTask extends Task
{

    protected $repository;

    public function __construct(CustomerFollowRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $where=[])
    {
        try {
            return $this->repository->where($where)->limit(1)->delete();
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
