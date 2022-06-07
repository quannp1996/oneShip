<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteCustomerGroupAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Customer@DeleteCustomerGroupTask', [$request->id]);
    }
}
