<?php

namespace App\Containers\Order\Tasks;

use App\Ship\Parents\Tasks\Task;
use Illuminate\Database\Eloquent\Collection;
use App\Containers\Order\Data\Repositories\OrderRepository;

class GetAllUnSyncOrderTask extends Task
{
    protected $items = [], $orderId = 0;
    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        $orders = $this->repository->whereNull('eshop_order_id')
                                   ->where('is_point_resync_failed', 0)
                                   ->whereHas('customer', function ($query) {
                                       $query->whereNotNull('email')
                                             ->whereNotNull('phone');
                                   })
                                   ->whereHas('orderItems.productVariant', function ($query) {
                                        $query->whereNotNull('eshop_variant_id');
                                   })
                                   
                                   ->latest()
                                   ->limit(10)
                                   ->get();
        return $orders;
    }   
}
