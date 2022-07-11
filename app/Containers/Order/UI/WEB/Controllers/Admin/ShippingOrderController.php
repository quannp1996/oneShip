<?php

namespace App\Containers\Order\UI\WEB\Controllers\Admin;

use App\Containers\Order\Actions\FindOrderByIdAction;
use App\Containers\Order\Events\Admin\Events\SendOrderToShippingEvent;
use App\Ship\Parents\Controllers\AdminController;
use App\Containers\Order\UI\WEB\Requests\Shipping\PushOrderToShippingRequest;

/**
 * ShippingOrderController
 *
 * @package App\Containers\Order\UI\WEB\Controllers
 */
class ShippingOrderController extends AdminController
{
  public function push(PushOrderToShippingRequest $request, FindOrderByIdAction $findOrderByIdAction)
  {
    try{
      $order = $findOrderByIdAction->run($request->id, 
        ['shipping', 'customer', 'senderProvince', 'senderDistrict', 'senderWard', 'receiverProvince', 'receiverDistrict', 'receiverWard']
      );
      SendOrderToShippingEvent::dispatch($order);
    }catch(\Exception $e){
      dd($e->getMessage());
    }
  }
}
