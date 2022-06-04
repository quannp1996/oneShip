<?php

namespace App\Containers\Order\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class UpdateOrderAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        $order = Apiato::call('Order@UpdateOrderTask', [$request->id, $data]);

        return $order;
    }
}
