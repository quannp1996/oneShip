<?php

namespace App\Containers\Menu\Tasks;

use App\Containers\Menu\Data\Repositories\MenuRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreateMenuTask extends Task
{

  protected $repository;

  public function __construct(MenuRepository $repository)
  {
    $this->repository = $repository;
  }

  public function run(array $data)
  {
    try {
      $menuInputData = Arr::except($data, ['menu_desc', '_token']);
      $menu = $this->repository->create($menuInputData);

      if ($menu) {
        foreach ($data['menu_desc'] as &$menuDesc) {
          $menuDesc['menu_id'] = $menu->id;
        }
        $result = $menu->all_desc()->createMany($data['menu_desc']);
      }
      return $menu;
    } catch (Exception $exception) {
      throw new CreateResourceFailedException();
    }
  }
}
