<?php

namespace App\Containers\Customer\Actions\FrontEnd\CustomerSearch;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Customer\Tasks\CustomerSearch\GetKeySearchByCustomerTask;

class GetKeySearchByCustomerAction extends Action
{
    public function run(int $customer_id)
    {
        $object =app(GetKeySearchByCustomerTask::class)->run($customer_id);
        return $object;
    }
}
