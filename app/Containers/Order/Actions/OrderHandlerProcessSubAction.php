<?php

namespace App\Containers\Order\Actions;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Ship\Parents\Actions\SubAction;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Order\Enums\OrderStatus;
use App\Containers\Settings\Enums\PaymentStatus;
use Carbon\Carbon;

class OrderHandlerProcessSubAction extends SubAction
{
  protected $status = false,
    $payment_status = false,
    $canUpdateUser = false;

  public function run(array $data)
  {
    DB::beginTransaction();
    try {

      $dataUpdate = Arr::only($data, $this->canUpdateUser ? ['id', 'user_id'] : ['id']);

      if ($this->status !== false) {
        $dataUpdate['status'] = $this->status;
      }

      if ($this->payment_status !== false) {
        $dataUpdate['payment_status'] = $this->payment_status;
        $dataUpdate['payment_time'] = Carbon::now()->format('Y/m/d H:i:s');
      }

      $order = Apiato::call('Order@UpdateOrderTask', [$dataUpdate['id'], $dataUpdate]);

      $orderLogPayload = Arr::except($data, ['id', 'user_id', '_headers']);

      // $orderLogPayload['status'] = $this->status;

      $orderLogPayload['order_id'] = $order->id;
      $orderLog = Apiato::call('Order@CreateOrderLogTask', [$orderLogPayload]);

      DB::commit();

      return $order;
    } catch (\Exception $e) {
      DB::rollback();
      throw $e;
    }
  }

  public function status(int $status = OrderStatus::NEW_ORDER): self
  {
    $this->status = $status;
    return $this;
  }

  public function paymentStatus(int $payment_status = PaymentStatus::NON_PAID): self
  {
    $this->payment_status = $payment_status;
    return $this;
  }

  public function setCanUpdateUser(bool $can = true): self
  {
    $this->canUpdateUser = $can;
    return $this;
  }
} // End class
