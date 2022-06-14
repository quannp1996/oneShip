<?php

namespace App\Containers\Location\Tasks;

use App\Containers\Location\Data\Criterias\FilterCityCriteria;
use App\Containers\Location\Data\Repositories\CityRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllCitiesTask extends Task
{

    protected $repository;

    public function __construct(CityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(bool $hasPagination = true,int $limit = 20,string $orderBy = 'id desc')
    {
        if($hasPagination === false){
            return $this->repository->get();
        }
        return $this->repository->paginate($limit);
    }

    public function withData(array $withData = [])
    {
        if(!empty($withData)) $this->repository->with($withData);
    }

    public function filterLocation(array $queryParam = []){
        
        $this->repository->pushCriteria( new FilterCityCriteria($queryParam));
    }    
}
