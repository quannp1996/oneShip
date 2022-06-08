<?php

namespace App\Containers\Order\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Order\Tasks\FindOrderByIdTask;
class FindOrderByIdAction extends Action
{
    public function run(int $id, array $with=[], array $column=['*'])
    {
      // $criteria = [
      //   ['with' => [$with]],
      //   ['selectFields' => [$column]]
      // ];
      // $order = Apiato::call('Order@FindOrderByIdTask', [$id], $criteria);
      $order = app(FindOrderByIdTask::class)->with($with)->selectFields($column)->run($id);

      return $order;
    }
}
