<?php

namespace App\Containers\Order\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class OrderAddLogAction extends Action
{
    public function run($id, $action = 'add', $note = '', $guard = 'admin')
    {
        return Apiato::call('Order@OrderAddLogTask', [$id, $action, $note, $guard]);
    }
}
