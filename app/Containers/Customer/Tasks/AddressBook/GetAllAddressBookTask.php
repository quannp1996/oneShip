<?php

namespace App\Containers\Customer\Tasks\AddressBook;

use App\Ship\Parents\Tasks\Task;
use Apiato\Core\Traits\FilterFields;
use Apiato\Core\Traits\withDataTrait;
use App\Containers\Customer\Data\Repositories\CustomerAddressBookRepository;

class GetAllAddressBookTask extends Task
{
    use withDataTrait, FilterFields;

    protected $repository;

    public function __construct(CustomerAddressBookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(bool $hasPagination = true, int $limit = 10)
    {
       if($hasPagination) return $this->repository->paginate($limit);
       if(!empty($limit)) return $this->repository->get();
       return $this->repository->take($limit)->get();
    }
}
