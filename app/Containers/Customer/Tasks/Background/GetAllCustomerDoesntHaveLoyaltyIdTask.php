<?php

namespace App\Containers\Customer\Tasks\Background;

use App\Ship\Parents\Tasks\Task;
use App\Containers\Customer\Data\Repositories\CustomerRepository;

class GetAllCustomerDoesntHaveLoyaltyIdTask extends Task
{

    protected $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
       return $this->repository->whereNull('loyalty_customer_code')
                               ->whereNotNull('email')
                            //    ->whereNotNull('phone')
                               ->latest()
                               ->limit(10)
                               ->get();
    }
}
