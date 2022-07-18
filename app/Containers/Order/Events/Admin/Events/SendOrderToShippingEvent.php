<?php

namespace App\Containers\Order\Events\Admin\Events;

use App\Ship\Parents\Events\Event;
use Illuminate\Queue\SerializesModels;
use App\Containers\Order\Models\Order;
use Apiato\Core\Abstracts\Events\Interfaces\ShouldHandleNow;
use App\Containers\Order\Actions\FindOrderByIdAction;

class SendOrderToShippingEvent extends Event implements ShouldHandleNow
{
    use SerializesModels;

    public $customerRefRevenue_id;
    public Order $order;

    public function __construct($orderID)
    {

        $this->order = app(FindOrderByIdAction::class)->run(
            $orderID,
            ['shipping', 'customer', 'senderProvince', 'senderDistrict', 'senderWard', 'receiverProvince', 'receiverDistrict', 'receiverWard']
        );
    }

    public function handle()
    {
    }

    public function broadcastOn()
    {
        return [];
    }
}
