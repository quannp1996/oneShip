<?php

namespace App\Containers\Location\Tasks;

use App\Ship\Parents\Tasks\Task;
use App\Containers\Location\Data\Criterias\FilterWardCriteria;
use App\Containers\Location\Data\Repositories\WardRepository;

class GetAllWardsTask extends Task
{

    protected $repository;

    public function __construct(WardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(bool $haspagination = true,int $limit = 20,string $orderBy = 'id desc')
    {
        if($haspagination === false) return $this->repository->get();
        return $this->repository->paginate($limit);
    }

    public function filterLocation(array $queryParams = [])
    {
        $this->repository->pushCriteria(new FilterWardCriteria($queryParams));
    }

    public function withData(array $withData = [])
    {
        if(!empty($withData)) $this->repository->with($withData);
    }
}
