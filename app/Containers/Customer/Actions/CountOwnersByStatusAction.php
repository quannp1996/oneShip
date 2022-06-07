<?php

namespace App\Containers\Customer\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\DB;

class CountOwnersByStatusAction extends Action
{
    public function run()
    {
        return Apiato::call('Customer@CountOwnersByStatusTask');
    }
}
