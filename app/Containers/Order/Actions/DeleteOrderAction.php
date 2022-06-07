<?php

namespace App\Containers\Order\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteOrderAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Order@DeleteOrderTask', [$request->id]);
    }
}
