<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-21 12:34:39
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-14 14:54:14
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\UI\API\Controllers\FrontEnd\Features;

use App\Containers\Order\Actions\GetAllOrdersAction;
use App\Containers\Order\Enums\OrderStatus;
use App\Containers\Order\UI\API\Requests\FrontEnd\OrderListRequest;
use App\Containers\Order\UI\API\Transformers\FrontEnd\OrderListCustomerTransformer;

trait OrderList
{
    public $data = [];
    public function orderList(OrderListRequest $request)
    {
        $this->data['status_options'] = $this->statusOptions($request->status);

        $orders = app(GetAllOrdersAction::class)->skipCache()->run(
            [
                'status' => $request->status,
                'customer_id' => $this->user->id
            ],
            [
                'paymentType.desc:payment_type_id,name',
                'deliveryType.desc:delivery_type_id,name',
                'orderItems',
                'orderItems.product:id,image'
            ],
            ['*'],
            10,
            $request->page ?? 1
        );

        // return $orders;
        $this->data['order_list'] = $this->transform($orders, new OrderListCustomerTransformer, [], [], 'order_list');
        $this->data['pagination'] = isset($this->data['order_list']['meta']['pagination']) ? $this->data['order_list']['meta']['pagination'] : [];
        $this->data['order_list'] = isset($this->data['order_list']['data']) ? $this->data['order_list']['data'] : [];

        return $this->data;
    }

    private function statusOptions(?string $selected) {
        return [
            [
                'title' => 'Tất cả',
                'status' => 0,
                'selected' => empty($selected) ? true : false
            ],
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
                'title' => OrderStatus::TEXT[OrderStatus::ON_DELIVERY],
                'status' => OrderStatus::ON_DELIVERY,
                'selected' => $selected == OrderStatus::ON_DELIVERY ? true : false
            ],
            [
                'title' => OrderStatus::TEXT[OrderStatus::DONE],
                'status' => OrderStatus::DONE,
                'selected' => $selected == OrderStatus::DONE ? true : false
            ],
            [
                'title' => OrderStatus::TEXT[OrderStatus::CANCEL],
                'status' => OrderStatus::CANCEL,
                'selected' => $selected == OrderStatus::CANCEL ? true : false
            ],
        ];
    }
}
