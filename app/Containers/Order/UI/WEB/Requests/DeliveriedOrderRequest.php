<?php

namespace App\Containers\Order\UI\WEB\Requests;

/**
 * Class DeliveriedOrderRequest.
 */
class DeliveriedOrderRequest extends UpdateStatusOrderRequest
{
    protected $noteKey = [
        'action_key' => 'deliveried',
        'note' => 'Đơn hàng giao thành công'
    ];
    
} // End class
