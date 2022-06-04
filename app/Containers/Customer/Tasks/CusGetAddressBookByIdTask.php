<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-28 21:46:47
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-29 11:16:49
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerAddressBookRepository;
use App\Containers\Customer\Models\CustomerAddressBook;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CusGetAddressBookByIdTask extends Task
{
    protected $repository;

    public function __construct(CustomerAddressBookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $customerId, int $addressId): ?CustomerAddressBook
    {
        try {
            $returnData = $this->repository->where('id',$addressId)->where('customer_id', $customerId);
            $returnData = $returnData->first();

            return $returnData;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
