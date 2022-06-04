<?php

namespace App\Containers\Customer\Actions\Background;

use App\Ship\Parents\Actions\Action;
use App\Containers\Customer\Tasks\Background\GetAllCustomerDoesntHaveLoyaltyIdTask;

class GetAllCustomerDoesntHaveLoyaltyIdAction extends Action
{
    public function run()
    {
        return app(GetAllCustomerDoesntHaveLoyaltyIdTask::class)->run();
    }
}
