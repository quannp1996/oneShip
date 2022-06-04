<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class StoreCustomerGroupsAction extends Action
{
    public function run(DataTransporter $dataTransporter)
    {
        $customergroup = Apiato::call('Customer@StoreCustomerGroupTask', [$dataTransporter->toArray()]);
        return $customergroup;
    }
}
