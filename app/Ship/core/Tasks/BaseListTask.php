<?php

namespace Apiato\Core\Tasks;

use App\Ship\Parents\Tasks\Task;
use Apiato\Core\Traits\withDataTrait;
use App\Containers\Project\Data\Repositories\ProjectRepository;

class BaseListTask extends Task
{
    use withDataTrait;
    protected $equalFields = [];
    protected $repository;

    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(bool $hasPagination = true, int $limit = null)
    {
        if($hasPagination) return $this->repository->paginate($limit ?? 10);
        if(!$limit || $limit == 1) return $this->repository->first();
        return $this->repository->take($limit ?? 10)->get();
    }
}
