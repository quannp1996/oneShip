<?php

namespace App\Containers\DashBoard\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetTopProductDashboardAction extends Action
{
  public function run($transporter, array $with=[], array $column=['*'], array $orderBy=[])
  {
    try {
      $dashboards = Apiato::call('Product@GetTopProductDashboardTask', [], [
        ['with' => [$with]],
        ['selectFields' => [$column]],
        ['orderByField' => [$orderBy]]
      ]);

      return $dashboards;
    }catch(\Exception $e) {
      throw $e;
    }
  }
} // End class
