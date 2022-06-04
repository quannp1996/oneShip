<?php

namespace App\Containers\Order\Actions;

use App\Containers\Order\Enums\OrderStatus;
use App\Ship\Parents\Actions\Action;

class DeliveriedOrderAction extends Action
{
  protected $status = OrderStatus::DELIVERED;

  public function run(array $data)
  {
    return app(OrderHandlerProcessSubAction::class)->status($this->status)->run($data);
  }
}
