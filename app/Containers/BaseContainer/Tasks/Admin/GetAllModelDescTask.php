<?php

namespace App\Containers\BaseContainer\Tasks\Admin;

use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetAllModelDescTask
{
    public function run($repositoryInstance, $parentObjId, $foreignKey)
    {
        $repositoryInstance->pushCriteria(new ThisEqualThatCriteria($foreignKey, $parentObjId));

        return $repositoryInstance->all()->keyBy('language_id')->toArray();
    }
}