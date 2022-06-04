<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-11-17 09:59:19
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-11-17 10:00:14
 * @ Description: Happy Coding!
 */

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class ThisNotInThatCriteria extends Criteria
{
    /**
     * @var
     */
    private $field;

    /**
     * @var
     */
    private $value;

    /**
     * ThisInThatCriteria constructor.
     *
     * @param $field
     * @param $value
     */
    public function __construct($field, $value)
    {
        $this->field = $field;
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
        return $model->whereNotIn($this->field, $this->value);
    }
}
