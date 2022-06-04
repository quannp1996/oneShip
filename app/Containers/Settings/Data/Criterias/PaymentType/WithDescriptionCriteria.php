<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-17 17:46:14
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 01:33:27
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Data\Criterias\PaymentType;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class WithDescriptionCriteria extends Criteria
{

    protected $language_id;

    public function __construct($language_id)
    {
        $this->language_id = $language_id;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        $language_id = $this->language_id;

        return $model->with(['desc' => function ($query) use ($language_id){
            $query->select('id', 'payment_type_id', 'language_id', 'name', 'short_description', 'image');
            $query->activeLang($language_id);
        }]);
    }
}
