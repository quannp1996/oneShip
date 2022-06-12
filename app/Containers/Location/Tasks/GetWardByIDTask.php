<?php

namespace App\Containers\Location\Tasks;

use App\Containers\Location\Data\Repositories\DistrictRepository;
use App\Containers\Location\Data\Repositories\WardRepository;
use App\Ship\Parents\Tasks\Task;

class GetWardByIDTask extends Task
{

    protected $repository;

    public function __construct(WardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $ward_id = 0)
    {
        return $this->repository->where('id', $ward_id)->first();
    }

}
