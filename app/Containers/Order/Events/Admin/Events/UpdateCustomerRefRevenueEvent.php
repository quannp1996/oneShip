<?php

namespace App\Containers\Order\Events\Admin\Events;

use Apiato\Core\Abstracts\Events\Interfaces\ShouldHandleNow;
use App\Containers\Order\Actions\FindOrderByIdAction;
use App\Ship\Parents\Events\Event;
use Illuminate\Queue\SerializesModels;
use App\Containers\Order\Models\order;

class UpdateCustomerRefRevenueEvent extends Event implements ShouldHandleNow
{
    use SerializesModels;

    public $customerRefRevenue_id;
    public $order;

    public function __construct(order $order,int $customerRefRevenue_id)
    {
        $this->order = $order;
        $this->customerRefRevenue_id = $customerRefRevenue_id;
    }

    public function handle()
    {
        // Do some handling here
    }

    public function broadcastOn()
    {
        return [];
    }
}
