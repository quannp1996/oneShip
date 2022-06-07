<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class FindOneCustomerByCondiationAction extends Action
{
    public function run(array $condition, array $withData = [], array $withCount = [])
    {
        $customer = Apiato::call('Customer@FindOneCustomerByConditionTask', [$condition]);
        return $customer;
    }
}
