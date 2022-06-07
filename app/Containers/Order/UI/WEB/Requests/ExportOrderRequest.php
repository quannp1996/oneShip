<?php

namespace App\Containers\Order\UI\WEB\Requests;

/**
 * Class ExportOrderRequest.
 */
class ExportOrderRequest extends UpdateStatusOrderRequest
{

    protected $noteKey = [
        'action_key' => 'export',
        'note' => 'Đơn hàng đã được xuất khỏi kho'
    ];
} // End class
