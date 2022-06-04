<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Customer\Models\Customer;

class SyncCustomerToGroupAction extends Action
{
    public function run(Customer $customer, array $groupIds=[])
    {
      return $customer->groups()->sync($groupIds);
    }
}
