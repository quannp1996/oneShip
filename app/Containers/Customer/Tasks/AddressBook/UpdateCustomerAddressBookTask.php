<?php

namespace App\Containers\Customer\Tasks\AddressBook;

use App\Ship\Parents\Tasks\Task;
use App\Containers\Customer\Data\Repositories\CustomerAddressBookRepository;

class UpdateCustomerAddressBookTask extends Task
{
    protected $repository;

    public function __construct(CustomerAddressBookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        return $this->repository->update($data, $id);
    }
}
