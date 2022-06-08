<?php

namespace App\Containers\Authorization\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class EqualNameCriteria.
 *
 */
class EqualNameCriteria extends Criteria
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('name',$this->name);
    }
}
