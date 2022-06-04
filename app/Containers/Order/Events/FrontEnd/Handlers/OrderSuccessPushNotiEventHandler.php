<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-21 14:44:04
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-22 17:16:14
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Events\FrontEnd\Handlers;

use App\Containers\BaseContainer\Events\Handlers\BaseFrontEventHandler;
use App\Containers\Notification\Actions\PushNotificationAction;
use App\Containers\Notification\Values\NotificationStructureValue;
use App\Containers\Order\Actions\FindOrderByIdAction;
use App\Containers\Order\Events\FrontEnd\Events\OrderSuccessEvent;

class OrderSuccessPushNotiEventHandler extends BaseFrontEventHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(OrderSuccessEvent $event)
    {
        $currentOrder = app(FindOrderByIdAction::class)->run($event->orderId,['customer','orderItems.product:id,image']);
        $order_item=$currentOrder->orderItems;
        $link=route('web_detail_profile_order',['token_tracking'=>$currentOrder->token_tracking]);
        $other_info=['id'=>$currentOrder->id,'image'=>@$order_item[0]->product->image,'status'=>@$currentOrder->status];
        if ( !empty($currentOrder->customer_id) ) {
            $message = sprintf('Đơn hàng: %s, vừa mới được tạo!', $currentOrder->code);

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
