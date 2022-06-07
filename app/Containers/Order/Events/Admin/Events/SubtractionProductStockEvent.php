<?php

namespace App\Containers\Order\Events\Admin\Events;

use Apiato\Core\Abstracts\Events\Interfaces\ShouldHandleNow;
use App\Containers\Order\Actions\FindOrderByIdAction;
use App\Ship\Parents\Events\Event;
use Illuminate\Queue\SerializesModels;

class SubtractionProductStockEvent extends Event implements ShouldHandleNow
{
    use SerializesModels;

    public $orderId;
    public $order;
    public $increase = false;

    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
        $this->order = app(FindOrderByIdAction::class)->run($orderId,['customer','orderItems']);
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
