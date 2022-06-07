<?php

namespace App\Containers\ShippingUnit\Tasks;

use Apiato\Core\Traits\FilterFields;
use App\Containers\ShippingUnit\Data\Repositories\ShippingUnitRepository;
use App\Ship\Criterias\Eloquent\ThisLikeThatCriteria;
use App\Ship\Parents\Tasks\Task;

class GetAllShippingUnitsTask extends Task
{
    use FilterFields;
    protected $repository;

    public function __construct(ShippingUnitRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }

    public function filter(array $condition = []): self
    {
        if($condition['title']){
            $this->repository->pushCriteria(new ThisLikeThatCriteria('title', '%'.$condition['title'].'%'));
        }
        return $this;
    }
}
