<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-21 14:44:04
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-26 11:09:58
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Events\FrontEnd\Handlers;

use App\Containers\BaseContainer\Events\Handlers\BaseFrontEventHandler;
use App\Containers\Bizfly\Actions\Mail\StoreMailCronAction;
use App\Containers\Order\Events\FrontEnd\Events\OrderCancelEvent;
use App\Containers\Order\Mails\OrderCancelMail;
use App\Containers\Settings\Actions\GetAllSettingsAction;
use Carbon\Carbon;

class OrderSendMailCancelHandler extends BaseFrontEventHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(OrderCancelEvent $event)
    {
        $settings = app(GetAllSettingsAction::class)->run('Array', true);
        $mailSubject = sprintf('['.env('APP_NAME').'] Đơn hàng "%s" đã hủy', $event->order->code);
        $mailContent = (new OrderCancelMail($event->order,$settings))->render();
        $mailCronData[] = [
            'email' => $event->order->email,
            'receive_id' => $event->order->customer->id,
            'receive_model' => get_class($event->order->customer),
            'object_id' => $event->order->id,
            'object_model' => get_class($event->order),
            'html' => preg_replace('~[\r\n]+~', '', $mailContent),
            'subject' => $mailSubject,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        app(StoreMailCronAction::class)->run($mailCronData);
    }
}
