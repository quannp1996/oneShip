<?php

namespace App\Containers\Location\Tasks;

use App\Ship\Parents\Tasks\Task;
use App\Containers\Location\Data\Criterias\FilterDistrictCriteria;
use App\Containers\Location\Data\Repositories\DistrictRepository;

class GetAllDistrictsTask extends Task
{

    protected $repository;

    public function __construct(DistrictRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(bool $hasPagination,int $limit = 20,string $orderBy = 'id desc')
    {
        if($hasPagination === false){
            return $this->repository->get();
        }
        return $this->repository->paginate($limit);
    }

    public function filterLocation($queryParam = [])
    {
        $this->repository->pushCriteria(new FilterDistrictCriteria($queryParam));
    }

    public function withData(array $withData = [])
    {
        if(!empty($withData)) {
            $this->repository->with('city');
        }
    }
}
