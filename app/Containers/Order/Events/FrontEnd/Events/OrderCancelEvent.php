<?php

namespace App\Containers\Order\Events\FrontEnd\Events;

use App\Containers\Order\Actions\FindOrderByIdAction;
use App\Ship\Parents\Events\Event;
use Illuminate\Queue\SerializesModels;

class OrderCancelEvent extends Event
{
    use SerializesModels;

    public $orderId;
    public $order;

    public function __construct(int $orderId,string $reason='')
    {
        $this->orderId = $orderId;
        $this->order = app(FindOrderByIdAction::class)->run($orderId,['customer']);
        $this->order->reason=$reason;
    }

    public function broadcastOn()
    {
        return [];
    }
}
