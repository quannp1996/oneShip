<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-10 15:16:16
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-30 13:58:45
 * @ Description: Happy Coding!
 */


namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class WithCriteria extends Criteria
{
  private $with, $externalWith = [];

  public function __construct(array $with = [], ?array $externalWith = [])
  {
    $this->with = $with;
    $this->externalWith = $externalWith;
  }

  public function apply($model, PrettusRepositoryInterface $repository)
  {

    if (!empty($this->externalWith)) {
      foreach ($this->with as $k => $item) {
        if (isset($this->externalWith[$item])) {
          $this->with[$item] = $this->externalWith[$item];
          unset($this->with[$k]);
        }
      }
    }

    $model = $model->with($this->with);
    return $model;
  }
}
