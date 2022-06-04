<?php

namespace App\Containers\Customer\Tasks;

use App\Ship\Parents\Tasks\Task;
use App\Containers\Customer\Data\Repositories\CustomerRefRevenueRepository;
use App\Containers\Customer\Data\Criterias\FilterLogOrderReferralCriteria;

class GetLogOrderReferralByCustomerTask extends Task
{

  protected $repository;

  public function __construct(CustomerRefRevenueRepository $repository)
  {
    $this->repository = $repository;
  }

  public function run(int $limit = 15)
  {
    return $this->repository->paginate($limit);
  }

  public function filter($filterTransporter)
  {
    $this->repository->pushCriteria(new FilterLogOrderReferralCriteria($filterTransporter));
  }



  
} // End class
