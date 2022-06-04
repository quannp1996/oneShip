<?php

namespace App\Containers\Order\Actions;

use App\Containers\Order\Enums\OrderStatus;
use App\Ship\Parents\Actions\Action;

class AcceptOrderAction extends Action
{
  protected $status = OrderStatus::ASSIGNED;

  public function run(array $data)
  {
    return app(OrderHandlerProcessSubAction::class)->status($this->status)->setCanUpdateUser(true)->run($data);
  }
}
