<?php

namespace App\Containers\Customer\Tasks;

use App\Ship\Parents\Tasks\Task;
use App\Containers\Customer\Data\Repositories\CustomerRepository;
use App\Containers\Customer\Data\Criterias\FilterCustomerCriteria;
use App\Containers\User\Data\Criterias\WithRoleCriteria;
use App\Ship\Criterias\Eloquent\SelectFieldsCriteria;

class GetAllCustomersTask extends Task
{

    protected $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $limit=15, $hasPagination = true)
    {
        if($hasPagination == false){
          return $this->repository->scopeQuery(function ($query) {
            return $query->orderBy('id', 'DESC');
          })->get();
        }
        return $this->repository->scopeQuery(function ($query) {
          return $query->orderBy('id', 'DESC');
        })->paginate($limit);
    }

    public function customerFilter($customerFilterTransporter) {
      $this->repository->pushCriteria(new FilterCustomerCriteria($customerFilterTransporter));
    }

    public function withRole() {
      $this->repository->pushCriteria(new WithRoleCriteria());
    }

    public function selectFields(array $column=['*']) {
      $this->repository->pushCriteria(new SelectFieldsCriteria($column));
    }
} // End class
