<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-11-21 12:13:06
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-11-21 16:09:53
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Events\Admin\Events;

use Apiato\Core\Abstracts\Events\Interfaces\ShouldHandleNow;
use App\Containers\Order\Actions\FindOrderByIdAction;
use App\Containers\Order\Models\Order;
use App\Ship\Parents\Events\Event;
use Illuminate\Queue\SerializesModels;

class IncreasePurchasedFlashsaleQuantityEvent extends Event implements ShouldHandleNow
{
    use SerializesModels;

    public $orderId;
    public $order;
    public $increase = true;

    public function __construct(int $orderId, ?Order $order)
    {
        $this->orderId = $orderId;
        $this->order = !empty($order) ? $order : app(FindOrderByIdAction::class)->run($orderId,['customer','orderItems']);
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
