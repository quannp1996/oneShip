<?php

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerRepository;
use App\Ship\Criterias\Eloquent\SelectFieldsCriteria;
use App\Ship\Criterias\Eloquent\WithCriteria;
use App\Ship\Parents\Tasks\Task;

class FilterCustomerBySeachableTask extends Task
{

    protected $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        return $this->repository->all();
    }

    // public function with(array $with=[]) {
    //   $this->repository->pushCriteria(new WithCriteria($with));
    // }

    public function selectFields(array $column=['*']) {
      $this->repository->pushCriteria(new SelectFieldsCriteria($column));
    }
} // End class
