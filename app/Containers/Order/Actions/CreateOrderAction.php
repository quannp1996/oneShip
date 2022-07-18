<?php

namespace App\Containers\Order\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\Order\Models\Order;
use App\Containers\Order\Tasks\CreateOrderTask;
use App\Containers\Order\Tasks\CreateOrderItemsTask;

class CreateOrderAction extends Action
{
    protected $items = [], $data = [];

    public function run(): Order
    {
        $order = app(CreateOrderTask::class)->setData($this->data)->run();
        return $order;
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

    public function setCustomer($id)
    {
        
    }
}
