<?php

namespace App\Containers\Menu\Tasks;

use App\Containers\Menu\Data\Repositories\MenuRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdatePositionMenuTask extends Task
{
  public $menuArray = [];

  protected $repository;

  public function __construct(MenuRepository $repository)
  {
    $this->repository = $repository;
  }

  public function run(array $menus)
  {
    try {
      $data = $this->getPosition($menus);
      return $this->repository->updateMultiple($data);
    } catch (Exception $exception) {
      throw new UpdateResourceFailedException();
    }
  }

  public function getPosition(array $menus = [], int $pid = 0)
  {
    if (!empty($menus)) {
      foreach ($menus as $index => $mn) {
        $this->menuArray[$mn['id']] = [
          'pid' => $pid,
          'sort_order' => $index
        ];

        if (!empty($mn['children'])) {
          $this->getPosition($mn['children'], $mn['id']);
        }
      }

      return $this->menuArray;
    }
  }
} // End Class
