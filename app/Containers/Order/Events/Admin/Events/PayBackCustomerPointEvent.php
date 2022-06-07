<?php

namespace App\Containers\Order\Events\Admin\Events;

use Apiato\Core\Abstracts\Events\Interfaces\ShouldHandleNow;
use App\Ship\Parents\Events\Event;
use Illuminate\Queue\SerializesModels;
use App\Containers\Order\Models\order;
use App\Containers\Bizfly\Actions\Loyalty\SavePointLoyaltyWithoutRateAction;
use App\Containers\Customer\Models\Customer;

class PayBackCustomerPointEvent extends Event implements ShouldHandleNow
{
    use SerializesModels;

    public $customerRefRevenue_id;
    public $order;

    public function __construct(order $order)
    {
      
        $customer = Customer::where('id', $order->customer_id)->first();
        app(SavePointLoyaltyWithoutRateAction::class)->run($customer, [
            'customer_id' => $customer->id,
        ], $order->point_value*$order->point_rate, 'HP');
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
