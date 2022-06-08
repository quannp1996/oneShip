<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class ByDateAvailableCriteria.
 *
 */
class ByDateAvailableCriteria extends Criteria
{
    private $date_available, $operation;

    public function __construct($date_available, $operation = '<=')
    {
        $this->date_available = $date_available;
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
        return $model->where('date_available', $this->operation, $this->date_available);
    }
}
