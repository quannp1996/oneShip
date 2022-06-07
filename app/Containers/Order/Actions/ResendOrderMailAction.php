<?php

namespace App\Containers\Order\Actions;

use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Mail;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;
use App\Containers\Order\Mails\OrderResendMail;
use App\Containers\Order\Events\Admin\Events\OrderResendMailEvent;
use Illuminate\Support\Arr;

class ResendOrderMailAction extends Action
{
    public function run($request)
    {
      $order = Apiato::call('Order@FindOrderByIdAction', [$request->id]);
      // $mail = Mail::send(new OrderResendMail($order));
      OrderResendMailEvent::dispatch($order->id);
      $orderLogPayload = Arr::except($request->all(), ['id']);
      $orderLog = Apiato::call('Order@CreateOrderLogTask', [$orderLogPayload]);
      return $order;
    }
}
