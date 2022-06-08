<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-28 21:46:47
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-19 23:23:54
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Tasks;

use App\Containers\Customer\Data\Repositories\CustomerAddressBookRepository;
use App\Containers\Customer\Models\Customer;
use App\Containers\Customer\Models\CustomerAddressBook;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CusSaveAddressBookTask extends Task
{
    protected $repository;

    public function __construct(CustomerAddressBookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(int $id = 0,int $customerId, array $data, bool $isCreating = true): ?CustomerAddressBook
    {
        try {
            if(isset($data['is_default']) && $data['is_default']) {
                $data['is_default'] = 1;
                $this->repository->getModel()->where('customer_id',$customerId)->update(['is_default' => 0]);
            }else {
                $data['is_default'] = 0;
            }

            $data['customer_id'] = $customerId;

            if ($isCreating && $id == 0) {
                return $this->repository->create($data);
            } else {
                return $this->repository->update($data, $id);
            }
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
