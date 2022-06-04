<?php

namespace App\Containers\Field\Tasks;

use App\Containers\Field\Data\Repositories\FieldRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteFieldTask extends Task
{

    protected $repository;

    public function __construct(FieldRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->delete($id);
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
