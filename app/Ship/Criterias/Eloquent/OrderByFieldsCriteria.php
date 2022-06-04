<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-22 00:32:09
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-22 00:35:36
 * @ Description: Happy Coding!
 */

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class OrderByFieldsCriteria extends Criteria
{

    private $fields;
    private $sortOrder;

    /**
     * OrderByFieldCriteria constructor.
     *
     * @param string $field The field to be sorted
     * @param string $sortOrder the sort direction (asc or desc)
     */
    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        $availableDirections = [
            'asc',
            'desc',
        ];

        foreach ($this->fields as $field) {
            if (count($field) == 2) {
                $sortOrder = Str::lower($field[1]);

                // check if the value is available, otherwise set "default" sort order to ascending!
                if (!array_search($sortOrder, $availableDirections)) {
                    $sortOrder = 'asc';
                }

                $this->sortOrder = $sortOrder;

                $model->orderBy($field[0], $this->sortOrder);
            }
        }

        return $model;
    }
}
