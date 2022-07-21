<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-07 13:09:51
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-30 12:29:01
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\UI\API\Transformers\FrontEnd;

use App\Containers\Order\Models\Order;
use App\Ship\Parents\Transformers\Transformer;

class OrderListCustomerTransformer extends Transformer
{
    public function transform(Order $order)
    {
        return [
            'id' => $order->id,
            'code' => $order->code,
            'sender_name' => $order->sender_fullname,
            'receiver_name' => $order->receiver_fullname,
            'shipping_title' => $order->relationLoaded('shipping') ? $order->shipping->title : '',
            'shipping_image' => $order->relationLoaded('shipping') ? $order->shipping->getImageUrl() : '',
            'created_at' => $order->created_at->format('d/m/Y H:i:s'),
            'statusText' => $order->getOrderStatusText(),
            'senderAddress' => $order->senderAddress(),
            'receiverAddress' => $order->receiverAddress(),
            'note' => $order->note
        ];
    }
}
