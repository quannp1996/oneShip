<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-21 14:44:04
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-11-21 16:06:09
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Events\Admin\Handlers;

use App\Containers\ShippingUnit\Helpers\CovertOrder;
use App\Containers\ShippingUnit\Business\ShippingFactory;
use App\Containers\BaseContainer\Events\Handlers\BaseFrontEventHandler;
use App\Containers\Order\Enums\OrderStatus;
use Exception;

class SendOrderToShippingEventHandler extends BaseFrontEventHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    public function handle($event)
    {
        try{
            $order = $event->order;
            $shippingUnit = $order->shipping;
            if(empty($shippingUnit)  || empty($order->customer))
            {
                throw new Exception('Đơn hàng lỗi, không thể đẩy sang đơn vị vận chuyển');
            }
            $shippingObject = ShippingFactory::getInstance($shippingUnit);
            $shippingObject->setCustomer($order->customer)->setOrder($order)->setDonhang(CovertOrder::covertOrderToDonHang($order));
            $response = $shippingObject->send();
            if(!$response['success']) throw new  Exception($response['message']);
            $order->update(['status' => OrderStatus::ORDER_SENT]);
        }catch(\Exception $e) {
            throw $e;
        }
    }
}
