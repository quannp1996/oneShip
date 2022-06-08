<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class FilterCustomerBySeachableAction extends Action
{
    public function run(DataTransporter $transporter, array $with=[], array $column=['*'])
    {
        $customers = Apiato::call('Customer@FilterCustomerBySeachableTask', [], [
          ['with' => [$with]],
          ['selectFields' => [$column]]
        ]);

        return $customers;
    }
}
