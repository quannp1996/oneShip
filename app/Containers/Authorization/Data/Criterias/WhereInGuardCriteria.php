<?php

namespace App\Containers\Authorization\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class WhereInGuardCriteria extends Criteria
{
  private $guards;

  public function __construct(array $guards=[])
  {
    $this->guards = $guards;
  }

  public function apply($model, PrettusRepositoryInterface $repository)
  {
    return $model->whereIn('guard_name', $this->guards);
  }
} // End class
