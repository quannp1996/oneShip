<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class ByCreatedCriteria.
 *
 */
class ByCreatedCriteria extends Criteria
{
    private $created_at,$operation;

    public function __construct($created_at,$operation = '<=')
    {
        $this->created_at = $created_at;
        $this->operation = $operation;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('created_at', $this->operation, $this->created_at);
    }
}
