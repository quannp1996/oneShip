<?php

namespace App\Containers\Location\Tasks;

use App\Containers\Location\Data\Repositories\WardRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateWardTask extends Task
{

    protected $repository;

    public function __construct(WardRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
