<?php

namespace App\Containers\Menu\Tasks;

use App\Containers\Menu\Data\Repositories\MenuRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllMenusTask extends Task
{

    protected $repository;

    public function __construct(MenuRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $with=[])
    {
        return $this->repository->with($with)->scopeQuery(function ($query) {
          return $query->where('status', '!=', '-1');
        })->orderBy('sort_order', 'ASC')->get();
    }
}
