<?php

namespace App\Containers\Order\UI\WEB\Controllers;

use App\Containers\Order\Models\Order;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Order\Actions\AcceptOrderAction;
use App\Containers\Order\Actions\AcceptOrderAgainAction;
use App\Containers\Order\Actions\DeliveriedOrderAction;
use App\Containers\Order\Actions\DeliveringOrderAction;
use App\Containers\Order\Actions\ExportOrderAction;
use App\Containers\Order\Actions\MarkCancelOrderAction;
use App\Containers\Order\Actions\MarkFinishOrderAction;
use App\Containers\Order\Actions\MarkPaidOrderAction;
use App\Containers\Order\Actions\MarkRefundOrderAction;
use App\Containers\Order\Actions\MarkWaitingPaymentOrderAction;
use App\Containers\Order\Actions\UnAcceptOrderAction;
use App\Containers\Order\Events\Admin\Events\DecreasePurchasedFlashsaleQuantityEvent;
use App\Containers\Order\Events\Admin\Events\IncreasePurchasedFlashsaleQuantityEvent;
use App\Containers\Order\Events\Admin\Events\RollbackProductStockEvent;
use App\Ship\Parents\Controllers\WebController;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;
use App\Containers\Order\UI\WEB\Requests\AcceptOrderRequest;
use App\Containers\Order\UI\WEB\Requests\GetAllOrdersRequest;
use App\Containers\Order\UI\WEB\Requests\FindOrderByIdRequest;
use App\Containers\Order\UI\WEB\Requests\MarkPaidOrderRequest;
use App\Containers\Order\UI\WEB\Requests\UnAcceptOrderRequest;
use App\Containers\Order\UI\WEB\Requests\MarkCancelOrderRequest;
use App\Containers\Order\UI\WEB\Requests\MarkFinishOrderRequest;
use App\Containers\Order\UI\WEB\Requests\MarkRefundOrderRequest;
use App\Containers\Order\Events\Admin\Events\SubtractionProductStockEvent;
use App\Containers\Order\UI\WEB\Requests\DeliveriedOrderRequest;
use App\Containers\Order\UI\WEB\Requests\DeliveringOrderRequest;
use App\Containers\Order\UI\WEB\Requests\ExportOrderRequest;
use App\Containers\Order\UI\WEB\Requests\MarkWaitingPaymentOrderRequest;
use App\Containers\Order\UI\WEB\Requests\ResendOrderMailRequest;
use App\Containers\Customer\Actions\FindCustomerRefRevenueByOrderIdAction;
use App\Containers\Order\Events\Admin\Events\UpdateCustomerRefRevenueEvent;
use App\Containers\Order\Events\Admin\Events\PayBackCustomerPointEvent;

/**
 * Class OrderProcessController
 *
 * @package App\Containers\Order\UI\WEB\Controllers
 */
class OrderProcessController extends WebController
{
  use ApiResTrait;
  /**
   * Tiếp nhận đơn
   *
   * @param GetAllOrdersRequest $request
   */
  public function acceptOrder(AcceptOrderRequest $request)
  {
    $request->user_id = auth()->guard(config('auth.guard_for.admin'))->id();
    $order = app(AcceptOrderAction::class)->run($request->toArray());
    // dd($order->id);
    IncreasePurchasedFlashsaleQuantityEvent::dispatch($request->id,$order);
    SubtractionProductStockEvent::dispatch($request->id);
    $msg = __('Tiếp nhận thành công');
    return $this->orderProcessResponse($order, $msg, $request);
  }

  /**
   * Tiếp lại nhận đơn
   *
   * @param AcceptOrderRequest $request
   */
  public function acceptOrdergain(AcceptOrderRequest $request)
  {
    $request->user_id = auth()->guard(config('auth.guard_for.admin'))->id();
    $order = app(AcceptOrderAgainAction::class)->run($request->toArray());
    $msg = __('Tiếp nhận lại đơn hàng thành công');
    return $this->orderProcessResponse($order, $msg, $request);
  }

  /**
   * Xuất khỏi kho
   * 
   * @param ExportOrderRequest $request
   */
  public function exportOrder(ExportOrderRequest $request)
  {
    $order = app(ExportOrderAction::class)->run($request->toArray());
    $msg = __('Đơn hàng đã được xuất kho');
    return $this->orderProcessResponse($order, $msg, $request);
  }

  /**
   * Đang giao hàng
   *
   * @param DeliveringOrderRequest $request
   */
  public function deliveringOrder(DeliveringOrderRequest $request)
  {
    $request->user_id = auth()->guard(config('auth.guard_for.admin'))->id();
    $order = app(DeliveringOrderAction::class)->run($request->toArray());

    $msg = __('Đơn hàng đang được giao');
    return $this->orderProcessResponse($order, $msg, $request);
  }

  /**
   * Giao hàng thành công
   *
   * @param DeliveriedOrderRequest $request
   */
  public function deliveriedOrder(DeliveriedOrderRequest $request)
  {
    $request->user_id = auth()->guard(config('auth.guard_for.admin'))->id();
    $order = app(DeliveriedOrderAction::class)->run($request->toArray());

    $msg = __('Đơn hàng đã được giao');
    return $this->orderProcessResponse($order, $msg, $request);
  }

  /**
   * Hủy tiếp nhận đơn
   *
   * @param FindOrderByIdRequest $request
   */
  public function unAcceptOrder(UnAcceptOrderRequest $request)
  {

    $order = app(UnAcceptOrderAction::class)->run($request->toArray());
    RollbackProductStockEvent::dispatch($order->id);
    DecreasePurchasedFlashsaleQuantityEvent::dispatch($request->id,$order);

    $msg = __('Bỏ tiếp nhận thành công');
    return $this->orderProcessResponse($order, $msg, $request);
  }

  /**
   * Đánh dấu là chờ
   *
   * @param MarkWaitingPaymentOrderRequest $request
   */
  public function markWaitingPaymentOrder(MarkWaitingPaymentOrderRequest $request)
  {
    $order = app(MarkWaitingPaymentOrderAction::class)->run($request->toArray());

    $msg = __('Đánh dấu là đơn hàng chờ thanh toán thành công');
    return $this->orderProcessResponse($order, $msg, $request);
  }

  /**
   * Đánh dấu đơn hàng là đã thanh toán
   *
   * @param MarkPaidOrderRequest $request
   */
  public function markPaidOrder(MarkPaidOrderRequest $request)
  {
    $order = app(MarkPaidOrderAction::class)->run($request->toArray());

    $msg = __('Đánh dấu là đơn hàng đã thanh toán thành công');
    return $this->orderProcessResponse($order, $msg, $request);
  }

  /**
   * Đánh dấu là đơn hàng hoàn thành
   *
   * @param MarkFinishOrderRequest $request
   */
  public function markFinishOrder(MarkFinishOrderRequest $request)
  {
    $request->user_id = auth()->guard(config('auth.guard_for.admin'))->id();
    $order = app(MarkFinishOrderAction::class)->run($request->toArray());
    $customerRefRevenue=app(FindCustomerRefRevenueByOrderIdAction::class)->run($order->id);
    // update điểm giới thiệu
    if(!empty($customerRefRevenue)){
      UpdateCustomerRefRevenueEvent::dispatch($order,$customerRefRevenue->id);
    }
    $msg = __('Đánh dấu là đơn hàng hoàn thành thành công');
    return $this->orderProcessResponse($order, $msg, $request);
  }

  /**
   * Đánh dấu là đơn hàng hoàn tiền
   *
   * @param MarkRefundOrderRequest $request
   */
  public function markRefundOrder(MarkRefundOrderRequest $request)
  {
    $order = app(MarkRefundOrderAction::class)->run($request->toArray());

    RollbackProductStockEvent::dispatch($order->id);
    DecreasePurchasedFlashsaleQuantityEvent::dispatch($request->id,$order);
    PayBackCustomerPointEvent::dispatch($order);

    $msg = __('Đánh dấu là đơn hàng hoàn tiền thành công');
    return $this->orderProcessResponse($order, $msg, $request);
  }

  /**
   * Đánh dấu là đơn hàng bị hủy
   *
   * @param MarkCancelOrderRequest $request
   */
  public function markCancelOrder(MarkCancelOrderRequest $request)
  {
    $order = app(MarkCancelOrderAction::class)->run($request->toArray());

    RollbackProductStockEvent::dispatch($order->id);
    DecreasePurchasedFlashsaleQuantityEvent::dispatch($request->id,$order);
    PayBackCustomerPointEvent::dispatch($order);
    
    $msg = __('Hủy đơn thành công');
    return $this->orderProcessResponse($order, $msg, $request);
  }

  public function resendOrderMail(ResendOrderMailRequest $request)
  {
    $order = Apiato::call('Order@ResendOrderMailAction', [$request]);
    $msg = __('Gửi thông tin đơn hàng cho khách qua email thành công');
    return $this->orderProcessResponse($order, $msg, $request);
  }

  private function orderProcessResponse(Order $order, string $msg = '', $request)
  {
    if ($request->ajax()) {
      return $this->sendResponse($order, $msg);
    }
    return redirect()->back()->with([
      'flash_level' => 'success',
      'flash_message' => $msg
    ]);
  }
} // End class
