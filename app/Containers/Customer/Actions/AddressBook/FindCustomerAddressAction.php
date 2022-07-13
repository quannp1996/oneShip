<?php

namespace App\Containers\Customer\Actions\AddressBook;

use App\Ship\Parents\Actions\Action;
use App\Containers\Customer\Tasks\AddressBook\FindCustomerAddressTask;

class FindCustomerAddressAction extends Action
{

    public function run($id, array $withData = [])
    {
        return app(FindCustomerAddressTask::class)->withData($withData)->run($id);
    }
}
