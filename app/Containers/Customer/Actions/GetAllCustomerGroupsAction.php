<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllCustomerGroupsAction extends Action
{
    public function run($column=['*'])
    {
        $customergroups = Apiato::call('Customer@GetAllCustomerGroupsTask', [], [
          ['selectFields' => [$column]],
          'visibleStatus',
          'withCountNumberOfCustomer'
        ]);

        return $customergroups;
    }
}
