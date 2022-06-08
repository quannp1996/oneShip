<?php

namespace App\Containers\Order\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class GetAllOrderLogsByOrderIdAction extends Action
{
  public function run(DataTransporter $dataTransporter, array $with=[], array $column=['*'])
  {
    $criteria = [
      ['with' => [$with]],
      ['selectFields' => [$column]],
    ];

    
    $order = Apiato::call('Order@FindOrderByIdTask', [$dataTransporter->id], $criteria);
    return $order;
  }
}
