<?php

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class ThisOperationThatCriteria
 */
class ThisOperationThatCriteria extends Criteria
{

    /**
     * @var
     */
    private $field;

    private $operation;

    /**
     * @var
     */
    private $value;

    /**
     * ThisEqualThatCriteria constructor.
     *
     * @param $field
     * @param $value
     */
    public function __construct($field, $value,$operation = '=')
    {
        $this->field = $field;
        $this->operation = $operation;
        $this->value = $value;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return  mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where($this->field,$this->operation, $this->value);
    }

}
