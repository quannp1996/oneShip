<?php

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Data\Repositories\OrderRepository;
use App\Containers\Order\Enums\OrderStatus;
use App\Containers\Settings\Enums\PaymentStatus;
use App\Ship\Parents\Tasks\Task;

class OrderRevenueDashboardTask extends Task
{

    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
      $revenue = $this->repository->where([
        'payment_status' => PaymentStatus::PAID
      ])->whereNotIn('status', [
        OrderStatus::CANCEL,
        OrderStatus::REFUND,
      ])->selectRaw(
        " DATE(created_at) as date, SUM(total_price) as total_price "
      )->groupBy('date')
       ->get()
       ->keyBy('date');

      return $revenue;
    }
}
