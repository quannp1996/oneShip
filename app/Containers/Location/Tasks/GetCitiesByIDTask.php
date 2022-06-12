<?php

namespace App\Containers\Location\Tasks;

use App\Containers\Location\Data\Criterias\FilterCityCriteria;
use App\Containers\Location\Data\Repositories\CityRepository;
use App\Ship\Parents\Tasks\Task;

class GetCitiesByIDTask extends Task
{

    protected $repository;

    public function __construct(CityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $cities_id = 0)
    {
        return $this->repository->where('id', $cities_id)->first();
    }

}
