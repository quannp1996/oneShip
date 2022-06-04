<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-10-14 17:15:38
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-14 17:22:14
 * @ Description: Happy Coding!
 */

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class OrderByFieldValuesCriteria extends Criteria
{

    private $field,$values;
    private $sortOrder;

    public function __construct(string $field,?array $values, string $sortOrder)
    {
        $this->field = $field;
        $this->values = $values;

        $sortOrder = Str::lower($sortOrder);
        $availableDirections = [
            'asc',
            'desc',
        ];

        if (! array_search($sortOrder, $availableDirections)) {
            $sortOrder = 'asc';
        }

        $this->sortOrder = $sortOrder;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        if(!empty($this->values)) {
            return $model->orderByRaw("FIELD(".$this->field.", '".implode("','",$this->values)."') ".$this->sortOrder);
        }
    }

}
