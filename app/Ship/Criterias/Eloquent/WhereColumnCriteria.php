<?php

namespace App\Ship\Criterias\Eloquent;

use Apiato\Core\Foundation\Facades\FunctionLib;
use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class WhereColumnCriteria extends Criteria
{
  private $whereFields;

  /**
   * Where fields
   *
   * @param array $whereFields: ['name' => 'Nguyen Van']
   */
  public function __construct(array $whereFields=[])
  {
    $this->whereFields = $whereFields;
  }

  public function apply($model, PrettusRepositoryInterface $repository) {
    $model = $model->where($this->whereFields);
    return $model;
  }
} // End class
