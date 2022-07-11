<?php

namespace App\Containers\Customer\Tasks\AddressBook;

use App\Ship\Parents\Tasks\Task;
use App\Containers\Customer\Data\Repositories\CustomerAddressBookRepository;

class DeleteCustomerAddressBookTask extends Task
{
    protected $repository;

    public function __construct(CustomerAddressBookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        return $this->repository->delete($id);
    }
}
