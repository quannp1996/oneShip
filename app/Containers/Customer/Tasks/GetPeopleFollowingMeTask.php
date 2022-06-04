<?php

namespace App\Containers\Customer\Tasks;

use App\Ship\Parents\Tasks\Task;
use App\Containers\Customer\Models\Customer;
use App\Containers\Customer\Data\Repositories\CustomerFollowRepository;

class GetPeopleFollowingMeTask extends Task
{

    protected $repository;

    public function __construct(CustomerFollowRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(Customer $customer)
    {
        return $this->repository->paginate();
    }
}
