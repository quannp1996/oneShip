<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class GetAllCustomersAction extends Action
{
    public function run(DataTransporter $transporter, $hasPagination = true ,array $withData=[], array $column=['*'])
    {
      $customers = Apiato::call('Customer@GetAllCustomersTask', [$transporter->limit, $hasPagination], [
        'withRole',
        ['selectFields' => [$column]],
        ['customerFilter' => [$transporter]],
        ['with' => [$withData]]
      ]);

      return $customers;
    }
}
