<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-21 14:44:04
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-22 17:56:44
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Events\Admin\Handlers;

use App\Containers\BaseContainer\Events\Handlers\BaseFrontEventHandler;
use App\Containers\Bizfly\Actions\Mail\StoreMailCronAction;
use App\Containers\Order\Events\Admin\Events\OrderResendMailEvent;
use App\Containers\Order\Mails\OrderResendMail;
use App\Containers\Settings\Actions\GetAllSettingsAction;
use Carbon\Carbon;

class OrderResendMailHandler extends BaseFrontEventHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(OrderResendMailEvent $event)
    {
        $mailSubject = sprintf('['.env('APP_NAME').'] Xác nhận thông tin đơn hàng "%s"', $event->order->code);
        $settings = app(GetAllSettingsAction::class)->run('Array', true);
        $mailContent = (new OrderResendMail($event->order,$settings))->render();
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
