<?php

namespace App\Containers\Menu\Tasks;

use App\Containers\Menu\Data\Repositories\MenuRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;

class GetMenusByTypeTask extends Task
{
    protected $repository;

    public function __construct(MenuRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($type = '1', array $with = [])
    {
        try {
            $menus = $this->repository->with($with);
            if (is_array($type)) {
                $menus = $menus->whereIn('type', $type);
            } else {
                $menus = $menus->where('type', $type);
            }

            $menus = $menus->where('status', '!=', config('menu-container.status.old_delete'))->orderBy('sort_order', 'ASC')->get();
            return $menus;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
