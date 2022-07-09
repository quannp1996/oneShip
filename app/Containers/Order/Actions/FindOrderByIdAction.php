<?php

namespace App\Containers\Order\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\Order\Tasks\FindOrderByIdTask;

class FindOrderByIdAction extends Action
{
  public function run($id, array $with = [], array $column = ['*'])
  {
    $order = app(FindOrderByIdTask::class)->with($with)->selectFields($column)->run($id);
    return $order;
  }
}
