<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class CountFollowersByCustomerIdsAction extends Action
{
    public function run(array $customerIds=[])
    {
        $customerFollows = Apiato::call('Customer@CountFollowersByCustomerIdsTask', [$customerIds], []);
        $customerFollows = $customerFollows->toArray();
        foreach ($customerIds as $cid) {
            if (!isset($customerFollows[$cid])) {
                $customerFollows[$cid] = [
                    'total_follow' => 0,
                    'customer_id' => $cid
                ];
            }
        }
        return $customerFollows;
    }
}
