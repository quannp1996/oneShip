<?php

namespace Apiato\Core\Traits;

use App\Ship\Criterias\Eloquent\WithCriteria;

trait withDataTrait
{
    public function withData(array $withData = []): self{
        if(!empty($withData)) $this->repository->pushCriteria(new WithCriteria($withData));
        return $this;
    }

    public function withCount(array $withCount = []): self{
        if(!empty($withCount)) $this->repository->withCount($withCount);
        return $this;
    }
}
