<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-21 14:44:04
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-22 17:16:14
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Events\Admin\Handlers;

use App\Containers\BaseContainer\Events\Handlers\BaseFrontEventHandler;
use App\Containers\Notification\Actions\PushNotificationAction;
use App\Containers\Notification\Values\NotificationStructureValue;
use App\Containers\Order\Actions\FindOrderByIdAction;
use App\Containers\Order\Events\Admin\Events\OrderResendMailEvent;

class OrderResendPushNotiEventHandler extends BaseFrontEventHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(OrderResendMailEvent $event)
    {
        $currentOrder = app(FindOrderByIdAction::class)->run($event->orderId,['customer','orderItems.product:id,image']);
        $order_item=$currentOrder->orderItems;
        $link=route('web_detail_profile_order',['token_tracking'=>$currentOrder->token_tracking]);
        $other_info=['id'=>$currentOrder->id,'image'=>@$order_item[0]->product->image];
        if ( !empty($currentOrder->customer_id) ) {
            $message = sprintf('HadaMall đã gửi mail xác nhận thông tin đơn hàng #"%s"!', $currentOrder->code);

            $notificationContentStructure = new NotificationStructureValue(
                $message, 
                $link, 
                $other_info, 
                $this->customer
            );
            return app(PushNotificationAction::class)->run(
                collect([$currentOrder->customer]), 
                $notificationContentStructure,
                'order'
            );
        }
    }
}
