<?php

namespace App\Containers\Field\Tasks;

use App\Containers\Field\Data\Repositories\FieldRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateFieldTask extends Task
{

    protected $repository;

    public function __construct(FieldRepository $repository)
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
