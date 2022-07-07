<?php

namespace App\Containers\Customer\Tasks\AddressBook;

use App\Ship\Parents\Tasks\Task;
use App\Containers\Customer\Data\Repositories\CustomerAddressBookRepository;

class CreateCustomerAddressBookTask extends Task
{
    protected $repository;

    public function __construct(CustomerAddressBookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        return $this->repository->create($data);
    }
}
