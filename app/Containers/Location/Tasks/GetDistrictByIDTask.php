<?php

namespace App\Containers\Location\Tasks;

use App\Containers\Location\Data\Repositories\DistrictRepository;
use App\Ship\Parents\Tasks\Task;

class GetDistrictByIDTask extends Task
{

    protected $repository;

    public function __construct(DistrictRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $district_id = 0)
    {
        return $this->repository->where('id', $district_id)->first();
    }

}
