<?php

namespace App\Containers\Customer\Actions\AddressBook;

use App\Containers\Customer\Tasks\AddressBook\GetAllAddressBookTask;
use App\Ship\Parents\Actions\Action;

class GetAllAddressBookAction extends Action
{

    public function run(array $condition, array $with = [])
    {
        return app(GetAllAddressBookTask::class)
            ->filter($condition)->withData($with)
            ->run();
    }
}
