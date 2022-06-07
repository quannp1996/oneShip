<?php

namespace App\Containers\Order\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\Order\Enums\OrderStatus;
use App\Containers\Settings\Enums\PaymentStatus;

class MarkPaidOrderAction extends Action
{
  protected $payment_status = PaymentStatus::PAID;
  public function run(array $data)
  {
    return app(OrderHandlerProcessSubAction::class)->paymentStatus($this->payment_status)->run($data);
  }
}
