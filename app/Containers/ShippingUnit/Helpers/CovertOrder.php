<?php

namespace App\Containers\ShippingUnit\Helpers;

use App\Containers\Order\Models\Order;
use App\Containers\ShippingUnit\Values\DonHang;

class CovertOrder
{
    public static function covertOrderToDonHang(Order $order): DonHang 
    {
        return new DonHang([
            'package' => json_decode($order->packages, true),
            'pick_up_method' => $order->pick_up_method,
            'sender' => [
                'province' => $order->sender_province,
                'district' => $order->sender_district,
                'ward' => $order->sender_ward,
            ],
            'receiver' => [
                'province' => $order->receiver_province,
                'district' => $order->receiver_district,
                'ward' => $order->receiver_ward,
            ],
            'services' => json_decode($order->services, true)
        ]);
    }
}   
