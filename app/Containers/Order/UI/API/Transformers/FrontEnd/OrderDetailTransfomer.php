<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-07 13:09:51
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-08 18:04:15
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\UI\API\Transformers\FrontEnd;

class OrderDetailTransfomer extends BaseOrderTransfomer
{
    public function transform($order)
    {
        $data = parent::transform($order);
// dd($order);
        $data['fullname'] = $order->fullname;
        $data['phone'] = $order->phone;
        $data['address'] = $order->address .
            ($order->relationLoaded('ward') && isset($order->ward->name) ? ', ' . $order->ward->name : '') .
            ($order->relationLoaded('district') && isset($order->district->name) ? ', ' . $order->district->name : '') .
            ($order->relationLoaded('province') && isset($order->province->name) ? ', ' . $order->province->name : '');

        return $data;
    }
}
