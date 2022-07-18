<?php

namespace App\Containers\Order\UI\WEB\Controllers\Admin;

use App\Containers\Order\Actions\FindOrderByIdAction;
use App\Containers\Order\Events\Admin\Events\SendOrderToShippingEvent;
use App\Ship\Parents\Controllers\AdminController;
use App\Containers\Order\UI\WEB\Requests\Shipping\PushOrderToShippingRequest;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;

/**
 * ShippingOrderController
 *
 * @package App\Containers\Order\UI\WEB\Controllers
 */
class ShippingOrderController extends AdminController
{
  use ApiResTrait;
  public function push(PushOrderToShippingRequest $request, FindOrderByIdAction $findOrderByIdAction)
  {
    try {
      SendOrderToShippingEvent::dispatch($request->id);
      return $this->sendResponse([
        'success' => true
      ]);
    } catch (\Exception $e) {
      return $this->sendError('error', 403, $e->getMessage());
    }
  }
}
