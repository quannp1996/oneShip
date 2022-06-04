<?php

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerFollowRepository;
use App\Ship\Criterias\Eloquent\OrderByCreationDateAscendingCriteria;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Parents\Tasks\Task;

class CountFollowersByCustomerIdsTask extends Task
{

    protected $repository;

    public function __construct(CustomerFollowRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $customerIds=[])
    {
       
        $result =  $this->repository->whereIn('customer_id', $customerIds)
                               ->selectRaw("COUNT(id) as total_follow, customer_id")
                               ->groupBy('customer_id')
                               ->get()
                               ->keyBy('customer_id');
        return $result;
    }
}
