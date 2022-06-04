<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-21 12:34:39
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-11-16 11:58:27
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\UI\API\Controllers\FrontEnd\Features;

use Apiato\Core\Transformers\Serializers\PureArraySerializer;
use App\Containers\Order\Actions\FindOrderByTokenAction;
use App\Containers\Order\Enums\OrderCancelReason;
use App\Containers\Order\Enums\OrderStatus;
use App\Containers\Order\UI\API\Requests\FrontEnd\OrderDetailRequest;
use App\Containers\Order\UI\API\Transformers\FrontEnd\OrderDetailTransfomer;

trait OrderDetail
{
    public $data = [];
    public function orderDetail(OrderDetailRequest $request)
    {
        $order = app(FindOrderByTokenAction::class)
            ->descProduct($this->currentLang)
            ->orderLocation()
            ->run($request->token_tracking, [
                'orderItems',
                'orderItems.product',
                'orderItems.product.desc',
                'province',
                'district',
                'ward'
            ]);
        // dd($order);

        if($order->orderItems->isNotEmpty()) {
            $order->orderItems = $order->orderItems->keyBy('variant_id');
        }

        $this->data['status_options'] = $this->statusOptionsDetail($order->status);
        $this->data["cancel_reasons"] = OrderCancelReason::TEXT;
        $this->data['status_cancel'] = $order->canCancelOrder();
        // return $order;
        $this->data['order'] = $this->transform($order, new OrderDetailTransfomer, [], [], 'order', new PureArraySerializer, false);

        // $this->data['order']['items'] = collect($this->data['order']['items'])->keyBy('variant_id');

        return $this->data;
    }

    private function statusOptionsDetail(?string $selected)
    {
        return [
            [
                'title' => OrderStatus::TEXT[OrderStatus::NEW_ORDER],
                'status' => OrderStatus::NEW_ORDER,
                'selected' => $selected == OrderStatus::NEW_ORDER ? true : false
            ],
            [
                'title' => OrderStatus::TEXT[OrderStatus::ASSIGNED],
                'status' => OrderStatus::ASSIGNED,
                'selected' => $selected == OrderStatus::ASSIGNED ? true : false
            ],
            [
                'title' => OrderStatus::TEXT[OrderStatus::EXPORTED],
                'status' => OrderStatus::EXPORTED,
                'selected' => $selected == OrderStatus::EXPORTED ? true : false
            ],
            [
                'title' => OrderStatus::TEXT[OrderStatus::ON_DELIVERY],
                'status' => OrderStatus::ON_DELIVERY,
                'selected' => $selected == OrderStatus::ON_DELIVERY ? true : false
            ],
            [
                'title' => OrderStatus::TEXT[OrderStatus::DONE],
                'status' => OrderStatus::DONE,
                'selected' => $selected == OrderStatus::DONE ? true : false
            ],
        ];
    }
}
