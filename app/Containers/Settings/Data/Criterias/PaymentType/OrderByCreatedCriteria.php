<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:46:14
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-24 20:23:18
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Data\Criterias\PaymentType;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class OrderByCreatedCriteria extends Criteria
{
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->orderBy('created_at', 'desc');
    }
}
