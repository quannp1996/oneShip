<?php

namespace App\Containers\Customer\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Containers\Customer\Tasks\FindCustomerRefRevenueByOrderIdTask;

class FindCustomerRefRevenueByOrderIdAction extends Action
{

    public function run(int $order_id, array $with=[])
    {
        $object = Apiato::call('Customer@FindCustomerRefRevenueByOrderIdTask', [$order_id], [
            ['with' => [$with]]
          ]);
     
        return $object;
    }

}
