<?php

namespace App\Containers\Order\Traits;

trait OrderPaymentTrait
{
  public function isPaymentStatusSuccess(): bool {
    return $this->payment_status == 1;
  }

  public function getPaymentStatusText(): string {
    if ($this->isPaymentStatusSuccess()) {
      return 'Đã thanh toán';
    }
    return 'Chưa thanh toán';
  }

  public function getPaymentText(): string {
    return !empty($this->paymentType) ? $this->paymentType->desc->name : '';
  }
} // End class

