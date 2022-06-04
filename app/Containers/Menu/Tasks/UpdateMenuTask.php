<?php

namespace App\Containers\Menu\Tasks;

use App\Containers\Menu\Data\Repositories\MenuRepository;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Arr;

class UpdateMenuTask extends Task
{

    protected $repository;

    public function __construct(MenuRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            $dataUpdate = Arr::except($data, ['menu_desc', '_token']);
            $dataUpdate['pid'] = (int)@$dataUpdate['pid'];
            if (empty($dataUpdate['no_follow'])) {
              $dataUpdate['no_follow'] = 0;
            }

            if (empty($dataUpdate['newtab'])) {
              $dataUpdate['newtab'] = 0;
            }

            $menu = $this->repository->update($dataUpdate, $id);
            return $menu;
        }
        catch (Exception $exception) {
            throw $exception;
        }
    }
}
