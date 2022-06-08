<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class IsNullCriteria
 *
 */
class SelectFieldsCriteria extends Criteria
{

    /**
     * @var
     */
    private $fields;

    /**
     * ThisFieldCriteria constructor.
     *
     * @param $field
     */
    public function __construct($fields = [])
    {
        $this->fields = $fields;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return  mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->select($this->fields);
    }
}
