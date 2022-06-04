<?php

namespace App\Containers\Customer\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class CountCustomersAction extends Action
{
    public function run()
    {
        return Apiato::call('Customer@CountCustomersTask', []);
    }
}
