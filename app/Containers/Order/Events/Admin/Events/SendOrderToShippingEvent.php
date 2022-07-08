<?php

namespace App\Containers\Order\Events\Admin\Events;

use App\Ship\Parents\Events\Event;
use Illuminate\Queue\SerializesModels;
use App\Containers\Order\Models\Order;
use Apiato\Core\Abstracts\Events\Interfaces\ShouldHandleNow;

class SendOrderToShippingEvent extends Event implements ShouldHandleNow
{
    use SerializesModels;

    public $customerRefRevenue_id;
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
    }

    public function broadcastOn()
    {
        return [];
    }
}
