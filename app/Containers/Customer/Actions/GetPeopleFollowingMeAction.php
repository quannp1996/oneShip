<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Customer\Models\Customer;

class GetPeopleFollowingMeAction extends Action
{
    public function run($request, Customer $customer, array $with=[])
    {
        $customerFollows = Apiato::call('Customer@FindFollowContractorByDataTask', [
            [
                ['customer_id', '=', $customer->id]
            ],

            $request
        ], [
            [ 'with' =>[ $with] ]
        ]);

        return $customerFollows;
    }
}
