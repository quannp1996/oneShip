<?php

namespace App\Containers\Customer\Tasks\AddressBook;

use App\Ship\Parents\Tasks\Task;
use Apiato\Core\Traits\FilterFields;
use Apiato\Core\Traits\withDataTrait;
use App\Containers\Customer\Data\Repositories\CustomerAddressBookRepository;

class FindCustomerAddressTask extends Task
{
    use withDataTrait, FilterFields;

    protected $repository;

    public function __construct(CustomerAddressBookRepository $repository)
    {
        $this->repository = $repository;
        $this->equalFields = ['customerID'];
    }

    public function run($id)
    {
        return $this->repository->find($id);
    }
}
