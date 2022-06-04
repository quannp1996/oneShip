<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class ThisInSubThatCriteria
 *
 */
class ThisInSubThatCriteria extends Criteria
{

    /**
     * @var
     */
    private $field;

    /**
     * @var
     */
    private $function;

    /**
     * ThisInSubThatCriteria constructor.
     *
     * @param $field
     * @param $function
     */
    public function __construct($field, $function)
    {
        $this->field = $field;
        $this->function = $function;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return  mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->whereIn($this->field, $this->function);
    }
}
