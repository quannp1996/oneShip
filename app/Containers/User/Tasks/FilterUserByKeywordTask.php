<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Ship\Criterias\Eloquent\SelectFieldsCriteria;
use App\Ship\Parents\Tasks\Task;

class FilterUserByKeywordTask extends Task
{

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
      $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
      return $this->repository->all();
    }

    public function selectFields(array $column=['*']) {
      $this->repository->pushCriteria(new SelectFieldsCriteria($column));
    }
}
