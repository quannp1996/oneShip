<?php

namespace App\Containers\BaseContainer\Traits;

use App\Containers\BaseContainer\Data\Criterias\ScopeFEAvailableDataCriteria;

trait ScopeFEAvailableDataTrait
{
    public function scopeFEAvailableData($request)
    {
        if (isset($request->scopeFEAvailableData) && $request->scopeFEAvailableData === true) {
            $languageId = $this->currentLang ? $this->currentLang->language_id : 1;

            $selectFieldsDesc = (!empty($request->selectFieldsDesc)) ? $request->selectFieldsDesc : ['*'];

            $this->repository->pushCriteria(new ScopeFEAvailableDataCriteria($languageId, $selectFieldsDesc));
        }

    }

}