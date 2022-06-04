<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class GetLogOrderReferralByCustomerAction extends Action
{
    public function run(DataTransporter $transporter,array $withData=[], array $column=['*'])
    {
      $object = Apiato::call('Customer@GetLogOrderReferralByCustomerTask', [$transporter->limit], [
        ['selectFields' => [$column]],
        ['filter' => [$transporter]],
        ['with' => [$withData]]
      ]);

      return $object;
    }
}
