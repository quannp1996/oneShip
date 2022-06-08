<?php

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Data\Repositories\OrderNoteRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class StoreOrderNoteTask extends Task
{

    protected $repository;

    public function __construct(OrderNoteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            return $this->repository->create($data);
        }
        catch (Exception $exception) {
            throw $exception;
        }
    }
}
