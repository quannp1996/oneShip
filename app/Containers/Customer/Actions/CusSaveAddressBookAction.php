<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-28 21:55:41
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-19 23:00:16
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Actions;

use App\Containers\Customer\Models\CustomerAddressBook;
use App\Containers\Customer\Tasks\CusSaveAddressBookTask;
use App\Ship\Parents\Actions\Action;

class CusSaveAddressBookAction extends Action
{
    public $cusSaveAddressBookTask;
    public function __construct(CusSaveAddressBookTask $cusSaveAddressBookTask)
    {
        $this->cusSaveAddressBookTask = $cusSaveAddressBookTask;
        parent::__construct();
    }

    public function run(int $id = 0,int $customerId, array $data,bool $isCreating = true): ?CustomerAddressBook
    {
        return $this->cusSaveAddressBookTask->run(
            $id,
            $customerId,
            $data,
            $isCreating
        );
    }
}
