<?php

namespace App\Containers\Field\Tasks;

use App\Containers\Field\Data\Repositories\FieldRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateFieldTask extends Task
{

    protected $repository;

    public function __construct(FieldRepository $repository)
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
