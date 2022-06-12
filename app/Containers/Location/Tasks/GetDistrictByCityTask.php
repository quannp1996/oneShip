<?php

namespace App\Containers\Location\Tasks;

use App\Ship\Parents\Tasks\Task;
use App\Containers\Location\Data\Repositories\DistrictRepository;

class GetDistrictByCityTask extends Task
{

    protected $repository;

    public function __construct(DistrictRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $cityID)
    {
        return $this->repository->where('province_id', $cityID)->get();
    }
}
