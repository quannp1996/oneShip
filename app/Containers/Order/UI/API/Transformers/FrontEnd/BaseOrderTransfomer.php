<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-07 13:09:51
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-11-16 12:53:26
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\UI\API\Transformers\FrontEnd;

use App\Containers\Order\Enums\OrderStatus;
use App\Containers\Settings\Enums\PaymentStatus;
use App\Ship\Parents\Transformers\Transformer;

class BaseOrderTransfomer extends Transformer
{
    protected array $defaultIncludes = [
        'items'
    ];
    
    public function transform($order)
    {
        $data['id'] = $order->id;
        $data['code'] = $order->code;
        $data['token_tracking'] = $order->token_tracking;
        $data['total_price'] = (double)$order->total_price;
        $data['total_paid'] =(double)($order->total_price + $order->fee_shipping - $order->point_value*$order->point_rate);
        $data['fee_shipping'] = (double)$order->fee_shipping;
        $data['created_at'] = $order->created_at;
        $data['coupon_code'] = $order->coupon_code;
        $data['coupon_value'] = (double)$order->coupon_value;

        $data['payment_type_text'] = @$order->paymentType->desc->name;
        $data['payment_type'] = @$order->paymentType->id;

        $data["payment_status"] = @$order->payment_status;
        $data['payment_status_text'] = @PaymentStatus::TEXT[$order->payment_status];

        $data['delivery_type_text'] = @$order->deliveryType->desc->name;
        $data['delivery_type'] = @$order->deliveryType->id;

        $data['point_value'] = @$order->point_value;
        $data['point_rate'] = @$order->point_rate;

        $data['status'] = @$order->status;
        $data['order_status_text'] = @OrderStatus::TEXT[$order->status];

        $data['link'] = routeFrontEndFromOthers('web_detail_profile_order',['token_tracking' => $order->token_tracking]);

        return $data;
    }

    public function includeItems($order)
    {
        $items = $order->orderItems;
        return (!empty($items) && !$items->IsEmpty()) ? $this->collection($items, new OrderItemTransfomer, 'items') : $this->null();
    }
}
