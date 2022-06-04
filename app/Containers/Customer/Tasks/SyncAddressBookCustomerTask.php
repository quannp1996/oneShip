<?php

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Models\CustomerAddress;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class SyncAddressBookCustomerTask extends Task
{

    protected $repository;

    public function __construct(CustomerAddress $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $customerID, array $addressBook)
    {
        try {
            $this->repository->where([
                'customer_id' => $customerID
            ])->delete();
            return $this->repository->insert($addressBook);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
