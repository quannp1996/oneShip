<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class GetLogReferralByCustomerAction extends Action
{
    public function run(DataTransporter $transporter,array $withData=[], array $column=['*'])
    {
      $object = Apiato::call('Customer@GetLogReferralByCustomerTask', [$transporter->limit], [
        ['selectFields' => [$column]],
        ['filter' => [$transporter]],
        ['with' => [$withData]]
      ]);

      return $object;
    }
}
