<?php

namespace App\Containers\Customer\Tasks;

use Exception;
use Illuminate\Support\Arr;
use App\Ship\Parents\Tasks\Task;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Containers\Customer\Data\Repositories\CustomerRepository;

class UpdateCustomerTask extends Task
{

    protected $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            $customerData = Arr::except($data, ['_token', 'roles_ids', 'permissions_ids', '_method']);
            $customer = $this->repository->update($customerData, $id);
            return $customer;
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
