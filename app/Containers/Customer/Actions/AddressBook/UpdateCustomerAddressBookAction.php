<?php

namespace App\Containers\Customer\Actions\AddressBook;

use App\Ship\Parents\Actions\Action;
use App\Containers\Customer\Tasks\AddressBook\UpdateCustomerAddressBookTask;

class UpdateCustomerAddressBookAction extends Action
{
    public function run(array $data)
    {
        return app(UpdateCustomerAddressBookTask::class)->run($data);
    }
}
