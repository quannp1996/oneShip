<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-24 22:40:42
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-13 12:09:10
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Actions\FrontEnd\CustomerSearch;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Customer\Tasks\CustomerSearch\DeleteCustomerSearchTask;

class DeleteCustomerSearchAction extends Action
{
    public function run($id)
    {
        $object = app(DeleteCustomerSearchTask::class)->run($id);
        return $object;
    }
}
