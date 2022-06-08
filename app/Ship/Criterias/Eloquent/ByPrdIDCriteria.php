<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class ByIdCriteria.
 *
 */
class ByPrdIDCriteria extends Criteria
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('product_id', 'LIKE', '%'.$this->id.'%');
    }
}
