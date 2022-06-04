<?php

namespace App\Containers\BaseContainer\Traits;

use App\Containers\BaseContainer\Data\Criterias\ScopeAdminBaseSearchCriteria;

trait ScopeAdminBaseSearchTrait
{
    public function extraSearchCondition($request)
    {
        // implement here
    }

    public function scopeAdminBaseSearch($request)
    {
        if (isset($request->scopeAdminBaseSearch) && $request->scopeAdminBaseSearch === true) {
            $this->repository->pushCriteria(new ScopeAdminBaseSearchCriteria($request));

            $this->extraSearchCondition($request);
        }
    }

    public function returnDataByLimit($limit = 20)
    {
        if (is_null($limit)) {
            return $this->repository->get();
        } else if ($limit === 0) {
            return $this->repository->first();
        } else {
            return ($limit < 0) ? $this->repository->take(abs($limit))->get() : $this->repository->paginate($limit);
        }
    }
}