<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-28 21:55:41
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-19 22:47:19
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Actions\FrontEnd;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Containers\Customer\Tasks\FindCustomerRefByCustomerTask;

class FindCustomerRefByCustomerAction extends Action
{

    public function run(int $customerId,int $limitDate=0)
    {
      
        $object =app(FindCustomerRefByCustomerTask::class)->with(['customerReferral'])->run($customerId, $limitDate);

        return $object;
    }

}
