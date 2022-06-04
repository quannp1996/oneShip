<?php

namespace App\Containers\Order\Actions;

use App\Containers\Order\Models\Order;
use App\Containers\Order\Tasks\CreateOrderItemsTask;
use App\Ship\Parents\Actions\Action;
use App\Containers\Order\Tasks\CreateOrderTask;
use Illuminate\Support\Facades\DB;
use App\Containers\Bizfly\Actions\Loyalty\SubPointLoyaltyAction;

class CreateOrderAction extends Action
{
    protected $items = [],$data;
    public function run(): Order
    {
        return DB::transaction(function () {

            $order = app(CreateOrderTask::class)->setData($this->data)->run();
            
            app(CreateOrderItemsTask::class)->setOrderId($order->id)->setItems($this->items)->run();

            return $order;
        });
    }

    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }

    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }
}
