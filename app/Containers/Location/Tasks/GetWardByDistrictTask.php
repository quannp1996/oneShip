<?php

namespace App\Containers\Location\Tasks;

use App\Ship\Parents\Tasks\Task;
use App\Containers\Location\Data\Repositories\WardRepository;

class GetWardByDistrictTask extends Task
{

    protected $repository;

    public function __construct(WardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $districtID)
    {
        return $this->repository->where('district_id', $districtID)->get();
    }
}
