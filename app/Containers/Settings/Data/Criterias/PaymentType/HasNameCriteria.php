<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:46:14
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 01:21:19
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Data\Criterias\PaymentType;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class HasNameCriteria extends Criteria
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        $name = $this->name;

        return $model->whereHas('desc', function ($query) use ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        });
    }
}
