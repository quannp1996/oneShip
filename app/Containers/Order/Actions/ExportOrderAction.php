<?php

namespace App\Containers\Order\Actions;

use App\Containers\Order\Enums\OrderStatus;
use App\Ship\Parents\Actions\Action;

class ExportOrderAction extends Action
{
  protected $status = OrderStatus::EXPORTED;

  public function run(array $data)
  {
    return app(OrderHandlerProcessSubAction::class)->status($this->status)->run($data);
  }
}
