<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\Customer\Tasks\GetAllCustomersTask;
use App\Ship\Transporters\DataTransporter;

class GetAllCustomersAction extends Action
{
  public function run(DataTransporter $transporter, $hasPagination = true, array $withData = [], array $column = ['*'])
  {
    $counting = [];
    $customers = app(GetAllCustomersTask::class)
      ->withRole()
      ->selectFields($column)
      ->customerFilter($transporter)
      ->with($withData);

    if(!empty($this->countingConds)) {
      $customers->counting($this->countingConds,$counting);
    }
      
    $customers = $customers->run($transporter->limit, $hasPagination);

    if(!empty($counting)) {
      $customers->counting = $counting;
    }

    return $customers;
  }
}
