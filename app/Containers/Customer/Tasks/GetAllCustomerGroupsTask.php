<?php

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerGroupRepository;
use App\Ship\Criterias\Eloquent\SelectFieldsCriteria;
use App\Ship\Criterias\Eloquent\VisibleStatusCriteria;
use App\Ship\Parents\Tasks\Task;

class GetAllCustomerGroupsTask extends Task
{

    protected $repository;

    public function __construct(CustomerGroupRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->orderBy('sort', 'ASC')->all();
    }

    public function visibleStatus() {
      $this->repository->pushCriteria(new VisibleStatusCriteria());
    }
} // End class
