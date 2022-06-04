<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-21 17:34:30
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-21 17:37:30
 * @ Description: Happy Coding!
 */

namespace App\Ship\Criterias\Eloquent;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class MustHaveDescCriteria extends Criteria
{
    private $languageId;

    public function __construct(int $languageId)
    {
        $this->languageId = $languageId;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->whereHas('desc', function ($q) {
            $q->where('language_id', $this->languageId);
            $q->whereNotNull('name');
            $q->where('name','!=', '');
        });
    }
}
