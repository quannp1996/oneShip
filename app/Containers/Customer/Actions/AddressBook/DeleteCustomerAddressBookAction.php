<?php

namespace App\Containers\Customer\Actions\AddressBook;

use App\Ship\Parents\Actions\Action;
use App\Containers\Customer\Tasks\AddressBook\DeleteCustomerAddressBookTask;

class DeleteCustomerAddressBookAction extends Action
{

    public function run($id)
    {
        return app(DeleteCustomerAddressBookTask::class)->run($id);
    }
}
