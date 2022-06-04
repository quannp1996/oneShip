<?php

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerRepository;
use App\Ship\Parents\Tasks\Task;
use Carbon\Carbon;

class GetNumberOfCustomerNewRegisterTask extends Task
{

    protected $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->whereDate('created_at', '>=', Carbon::now()->subDays(30))->count('id');
    }
}
