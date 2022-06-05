<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-17 17:46:14
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-17 17:48:43
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Data\Criterias\DeliveryType;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class WithAllDescriptionCriteria extends Criteria
{
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->with('all_desc');
    }
}
