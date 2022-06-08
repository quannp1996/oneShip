<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class UpdateCustomerGroupAction extends Action
{
    public function run(DataTransporter $dataTransporter)
    {
        $customergroup = Apiato::call('Customer@UpdateCustomerGroupTask', [$dataTransporter->id, $dataTransporter->toArray()]);

        return $customergroup;
    }
}
