<?php

namespace App\Containers\Order\Traits;

use App\Containers\Order\Enums\OrderStatus;
use App\Containers\Settings\Enums\PaymentStatus;

trait OrderScopeTrait
{
  public function scopeWhereNewOrder($query) {
    return $query->where(function ($q) {
      $q->where('status', OrderStatus::NEW_ORDER)
        ->where('user_id', 0);
    });
  }

  public function scopeWhereReceiveOrder($query) {
    return $query->where('status', OrderStatus::ASSIGNED);
  }

  public function scopeWhereWaitForPaidOrder($query) {
    return $query->where('payment_status', PaymentStatus::NON_PAID);
  }

  public function scopeWherePaidOrder($query) {
    return $query->where('status', OrderStatus::PAID);
  }

  public function scopeWhereRefundOrder($query) {
    return $query->where('status', OrderStatus::REFUND);
  }

  public function scopeWhereCancelOrder($query) {
    return $query->where('status', OrderStatus::CANCEL);
  }

  public function scopeWhereFinishOrder($query) {
    return $query->where('status', OrderStatus::DONE);
  }
} // End class

