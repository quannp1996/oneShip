<?php

namespace App\Containers\Customer\Actions\AddressBook;

use App\Ship\Parents\Actions\Action;
use App\Containers\Customer\Tasks\AddressBook\CreateCustomerAddressBookTask;

class CreateCustomerAddressBookAction extends Action
{

    public function run(array $data)
    {
        return app(CreateCustomerAddressBookTask::class)->run($data);
    }
}
