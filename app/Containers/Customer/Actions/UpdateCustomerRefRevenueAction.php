<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class UpdateCustomerRefRevenueAction extends Action
{
    public function run($data)
    {
        $customerData = Apiato::call('Customer@UpdateCustomerRefRevenueTask', [$data['id'], $data]);

        return $customerData;
    }
}
