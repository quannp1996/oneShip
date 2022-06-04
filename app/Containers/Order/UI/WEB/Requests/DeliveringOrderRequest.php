<?php

namespace App\Containers\Order\UI\WEB\Requests;

/**
 * Class DeliveringOrderRequest.
 */
class DeliveringOrderRequest extends UpdateStatusOrderRequest
{
    protected $noteKey = [
        'action_key' => 'on_devery',
        'note' => 'Đơn hàng đang được giao'
    ];
} // End class
