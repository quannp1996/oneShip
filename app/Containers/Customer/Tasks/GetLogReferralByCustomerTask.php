<?php

namespace App\Containers\Customer\Tasks;

use App\Ship\Parents\Tasks\Task;
use App\Containers\Customer\Data\Repositories\CustomerRefRepository;
use App\Containers\Customer\Data\Criterias\FilterLogCustomerReferralCriteria;

class GetLogReferralByCustomerTask extends Task
{

  protected $repository;

  public function __construct(CustomerRefRepository $repository)
  {
    $this->repository = $repository;
  }

  public function run(int $limit = 15)
  {
    return $this->repository->paginate($limit);
  }

  public function filter($filterTransporter)
  {
    $this->repository->pushCriteria(new FilterLogCustomerReferralCriteria($filterTransporter));
  }

  
} // End class
