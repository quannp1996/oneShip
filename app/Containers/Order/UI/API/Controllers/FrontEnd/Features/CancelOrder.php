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

use App\Containers\Order\Actions\MarkCancelOrderAction;
use App\Containers\Order\Actions\StoreOrderNoteAction;
use App\Containers\Order\Enums\OrderCancelReason;
use App\Containers\Order\UI\API\Requests\FrontEnd\CancelOrderRequest;
use App\Containers\Order\UI\API\Transformers\FrontEnd\OrderListCustomerTransformer;
use App\Containers\Order\Events\Admin\Events\RollbackProductStockEvent;
use App\Containers\Order\Events\FrontEnd\Events\OrderCancelEvent;
use App\Core as Core;

trait CancelOrder
{
    public function cancelOrder(CancelOrderRequest $request)
    {
        $param=$request->except( ['reason_key','message','order_action','order_id','reason']);
        $order = app(MarkCancelOrderAction::class)->run($param);
        
        $paramNote = $request->toTransporter();
        $paramNote->order_id=$request->id;
        $paramNote->title='Huỷ đơn';
        $note=app(StoreOrderNoteAction::class)->run($paramNote);
        
        RollbackProductStockEvent::dispatch($order->id);
        $reason= OrderCancelReason::TEXT[$request->reason_key].'; '.$request->reason;
        if($order->isCancelOrder()){
        //  dd(123);
            OrderCancelEvent::dispatch($order->id,$reason);
        }
       
        return $this->sendResponse(_('Huỷ đơn hàng thành công'));
    }
    
   
}
