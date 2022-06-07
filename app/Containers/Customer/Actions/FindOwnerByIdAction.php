<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class FindOwnerByIdAction extends Action
{
    public function run(int $customerId, array $withData = [], array $withCount = [])
    {
        $customer = Apiato::call('Customer@FindCustomerByIdTask', [$customerId, $withData], [
            [
                'withCount' => [$withCount]
            ],
            [
                'withData' => [$withData]
            ]
        ]);

        return $customer;
    }
}
