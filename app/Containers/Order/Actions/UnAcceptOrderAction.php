<?php

namespace App\Containers\Order\Actions;

use App\Containers\Order\Enums\OrderStatus;
use App\Ship\Parents\Actions\Action;

class UnAcceptOrderAction extends Action
{
  public function run(array $data)
  {
    $data['user_id'] = 0;
    return app(OrderHandlerProcessSubAction::class)->setCanUpdateUser()->status(OrderStatus::NEW_ORDER)->run($data);
  }
}
