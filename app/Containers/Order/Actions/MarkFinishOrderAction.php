<?php

namespace App\Containers\Order\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\Order\Enums\OrderStatus;

class MarkFinishOrderAction extends Action
{
  protected $status = OrderStatus::DONE;

  public function run(array $data)
  {
    return app(OrderHandlerProcessSubAction::class)->status($this->status)->run($data);
  }
}
