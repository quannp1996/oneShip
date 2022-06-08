<?php

namespace App\Containers\Order\Actions;

use App\Containers\Order\Enums\OrderStatus;
use App\Containers\Settings\Enums\PaymentStatus;
use App\Ship\Parents\Actions\Action;

class MarkWaitingPaymentOrderAction extends Action
{
  protected $payment_status = PaymentStatus::NON_PAID;

  public function run(array $data)
  {
    return app(OrderHandlerProcessSubAction::class)->paymentStatus($this->payment_status)->run($data);
  }
}
