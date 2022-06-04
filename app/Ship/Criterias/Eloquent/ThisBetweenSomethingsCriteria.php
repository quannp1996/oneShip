<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-12 16:59:57
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-04 15:00:12
 * @ Description: Happy Coding!
 */

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Illuminate\Database\Query\Builder;

class ThisBetweenSomethingsCriteria extends Criteria
{

    /**
     * @var float
     */
    private $start;

    /**
     * @var float
     */
    private $end;

    /**
     * @var string
     */
    private $field;


    public function __construct($field, float $start, float $end)
    {
        $this->start = $start;
        $this->end = $end;
        $this->field = $field;
    }

    /**
     * Applies the criteria
     * 
     * @param Builder $model
     * @param         $repository
     * 
     * @return        mixed
     */
    public function apply($model, $repository)
    {
        if($this->end > 0) {
            return $model->whereBetween($this->field, [$this->start, $this->end]);
        }else {
            return $model->where($this->field, '>=',$this->start);
        }
    }
}
