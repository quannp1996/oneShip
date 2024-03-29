<?php

namespace App\Containers\Location\Tasks;

use App\Containers\Location\Data\Repositories\CityRepository;
use App\Containers\Location\Data\Repositories\DistrictRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateDistrictTask extends Task
{

    protected $repository;

    public function __construct(DistrictRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            return $this->repository->create($data);
        }
        catch (Exception $exception) {

            throw new CreateResourceFailedException();
        }
    }
}
