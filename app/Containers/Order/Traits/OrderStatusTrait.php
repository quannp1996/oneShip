<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-10 15:16:16
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-10-03 17:13:07
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Traits;

use App\Containers\Order\Enums\OrderStatus;
use App\Containers\Settings\Enums\PaymentStatus;

trait OrderStatusTrait
{
  public function isCancelOrder(): bool
  {
    return $this->status == OrderStatus::CANCEL;
  }

  public function isNewOrder(): bool
  {
    return $this->status == OrderStatus::NEW_ORDER && empty($this->user_id);
  }


  public function isWaitForPaidOrder(): bool
  {
    return $this->payment_status == PaymentStatus::NON_PAID;
  }

  public function isPaidOrder(): bool
  {
    return $this->status == OrderStatus::PAID;
  }

  public function isExportOrder(): bool
  {
    return $this->status == OrderStatus::EXPORT_TO;
  }

  public function isDeliveryOrder(): bool
  {
    return $this->status == OrderStatus::ON_DELIVERY;
  }

  public function isDeliveriedOrder(): bool
  {
    return $this->status == OrderStatus::DELIVERED;
  }

  public function isRefundOrder(): bool
  {
    return $this->status == OrderStatus::REFUND;
  }

  public function getOrderStatusText(): string
  {
    $text = isset(OrderStatus::TEXT[$this->status]) ? OrderStatus::TEXT[$this->status] : '';
    return $text ? $text : 'Không xác định';
  }

  public function canCancelOrder(): bool
  {
    return (!$this->isFinishOrder() && !$this->isRefundOrder() && !$this->isPaidOrder() && !$this->isCancelOrder());
  }

  public function canRefundOrder(): bool
  {
    return ($this->isPaymentStatusSuccess() && !$this->isRefundOrder() && !$this->isFinishOrder());
  }

  public function canReceiveOrder(): bool
  {
    return ($this->isNewOrder() || $this->isCancelOrder());
  }

  public function canProcessOrder(): bool
  {
    return $this->user_id == auth()->guard(config('auth.guard_for.admin'))->id();
  }
} // End class
