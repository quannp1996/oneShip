<?php

namespace App\Containers\Order\Events\FrontEnd\Events;

use App\Containers\Order\Actions\FindOrderByIdAction;
use App\Ship\Parents\Events\Event;
use Illuminate\Queue\SerializesModels;

class OrderSuccessEvent extends Event
{
    use SerializesModels;

    public $orderId;
    public $order;

    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
        $this->order = app(FindOrderByIdAction::class)->run($orderId,['customer','orderItems','orderItems.product',
        'province:id,name', 'district:id,name', 'ward:id,name']);
    }

    public function broadcastOn()
    {
        return [];
    }
}
