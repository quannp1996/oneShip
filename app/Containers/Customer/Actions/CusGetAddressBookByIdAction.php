<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-28 21:55:41
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-08-28 23:05:04
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Actions;

use App\Containers\Customer\Models\CustomerAddressBook;
use App\Containers\Customer\Tasks\CusGetAddressBookByIdTask;
use App\Ship\Parents\Actions\Action;

class CusGetAddressBookByIdAction extends Action
{
    public $cusGetAddressBookByIdTask;
    public function __construct(CusGetAddressBookByIdTask $cusGetAddressBookByIdTask)
    {
        $this->cusGetAddressBookByIdTask = $cusGetAddressBookByIdTask;
        parent::__construct();
    }

    public function run(int $customerId, int $addressId): ?CustomerAddressBook
    {
        return $this->cusGetAddressBookByIdTask->run(
            $customerId,
            $addressId
        );
    }
}
