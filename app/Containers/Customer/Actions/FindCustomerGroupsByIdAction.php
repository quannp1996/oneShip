<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindCustomerGroupsByIdAction extends Action
{
    public function run(Request $request)
    {
        $customergroup = Apiato::call('Customer@FindCustomerGroupByIdTask', [$request->id]);

        return $customergroup;
    }
}
