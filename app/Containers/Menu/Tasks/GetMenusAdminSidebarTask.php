<?php

namespace App\Containers\Menu\Tasks;

use App\Containers\Menu\Data\Repositories\MenuRepository;
use App\Ship\Parents\Tasks\Task;

class GetMenusAdminSidebarTask extends Task
{

    protected $repository;

    public function __construct(MenuRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(string $type='1', array $with=[])
    {
        return $this->repository->getSidebarMenuTree($type, $with);
    }
}
