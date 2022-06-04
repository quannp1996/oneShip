<?php

namespace App\Containers\Menu\Tasks;

use App\Containers\Menu\Data\Repositories\MenuRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindMenuByIdTask extends Task
{

    protected $repository;

    public function __construct(MenuRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $with=[])
    {
        try {
            return $this->repository->with($with)->find($id);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
