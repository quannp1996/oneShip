<?php

namespace App\Containers\Order\UI\WEB\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;
use Apiato\Core\Foundation\Facades\FunctionLib;
use App\Containers\BaseContainer\Actions\CreateBreadcrumbAction;
use App\Containers\Order\Actions\CreateOrderAction;
use App\Containers\Order\Actions\GetAllOrdersAction;
use App\Containers\Order\Enums\EnumShipPicking;
use App\Containers\Order\Enums\OrderStatus;
use App\Ship\Parents\Controllers\WebController;
use App\Ship\Parents\Controllers\AdminController;
use App\Containers\Order\UI\WEB\Requests\EditOrderRequest;
use App\Containers\Order\UI\WEB\Requests\StoreOrderRequest;
use App\Containers\Order\UI\WEB\Requests\CreateOrderRequest;
use App\Containers\Order\UI\WEB\Requests\DeleteOrderRequest;
use App\Containers\Order\UI\WEB\Requests\UpdateOrderRequest;
use App\Containers\Order\UI\WEB\Requests\GetAllOrdersRequest;
use App\Containers\Order\UI\WEB\Requests\FindOrderByIdRequest;
use App\Containers\Settings\Enums\PaymentStatus;
use App\Containers\ShippingUnit\Business\ShippingFactory;
use App\Containers\ShippingUnit\Business\ShippingUnitInterface;
use App\Containers\ShippingUnit\Models\ShippingUnit;
use Illuminate\Support\Facades\Auth;

/**
 * Class Controller
 *
 * @package App\Containers\Order\UI\WEB\Controllers
 */
class OrderController extends AdminController
{
  public function __construct()
  {
    $this->title = 'Quản trị đơn hàng';
    $method = request()->route()->getActionMethod();
    if (in_array($method, ['edit', 'show', 'update', 'delete'])) {
      $this->dontUseShareData = true;
    }
    view()->share('ordersType', OrderStatus::TEXT);
    view()->share('pickUp', EnumShipPicking::LIST);
    parent::__construct();
  }

  /**
   * Show all entities
   *
   * @param GetAllOrdersRequest $request
   */
  public function index(GetAllOrdersRequest $request)
  {
    $shipingInstance = ShippingFactory::getInstance(ShippingUnit::find('62a0b696862aa3ba0508b63e'));
    dd($shipingInstance->caculateShipping());
    $filters = $request->all();
    app(CreateBreadcrumbAction::class)->run('list', $this->title, 'admin.orders.index');
    $orders = app(GetAllOrdersAction::class)->skipCache()->run(
      $filters,
      [
        'user:id,name,email',
        'logs' => function ($query) {
          $query->where('action_key', 'email_admin')->select('id', 'order_id');
        },
        'paymentType.desc:payment_type_id,name',
        'deliveryType.desc:delivery_type_id,name',
        'orderItems'
      ],
      [
        'id',
        'customer_id',
        'fullname',
        'email',
        'phone',
        'code',
        'total_price',
        'fee_shipping',
        'created_at',
        'status',
        'user_id',
        'payment_status',
        'payment_type',
        'delivery_type',
        'coupon_code',
        'coupon_value',
        'eshop_order_id',
        'eshop_shipping_id',
        'point_value',
        'point_rate'
      ],
      20,
      $request->page ?? 1
    );

    // dd($orders);

    $users = collect([]);
    if (isset($filters['user_id']) && $filters['user_id']) {
      $users = Apiato::call('User@GetAllUserNoLimitAction', [
        [
          ['id', '=', $filters['user_id']]
        ],

        ['id', 'name', 'email']
      ]);
    }
    return view('order::index', [
      'orders' => $orders,
      'search_data' => $request,
      'ordersType' => OrderStatus::TEXT,
      'orderPaymmentStatus' => PaymentStatus::TEXT,
      'eidStatus' => $filters['eid_status'] ?? '',
      'users' => $users
    ]);
  }

  /**
   * Show one entity
   *
   * @param FindOrderByIdRequest $request
   */
  public function show(FindOrderByIdRequest $request)
  {
    $order = Apiato::call('Order@FindOrderByIdAction', [
      $request->id,
      [
        'orderItems' => function ($q) {
          $q->orderBy('id');
        },
        'user:id,name,email',
        'notes', 'province:id,name',
        'district:id,name',
        'ward:id,name'
      ]
    ]);

    return view('order::show', [
      'order' => $order,
      'input' => $request->all()
    ]);
  }

  /**
   * Create entity (show UI)
   *
   * @param CreateOrderRequest $request
   */
  public function create(CreateOrderRequest $request)
  {
    $this->editMode = false;
    return view('order::add');
  }

  /**
   * Add a new entity
   *
   * @param StoreOrderRequest $request
   */
  public function store(StoreOrderRequest $request, CreateOrderAction $createOrderAction)
  {
    try {
      $data = $request->sanitizeInput([
        'userID', 'sender', 'receiver', 'package', 'shipping', 'shipping_cod', 'shipping_type'
      ]);
      $order = $createOrderAction->setData($data)->setItems($data['package']['items'])->run();
      return $this->sendResponse([
        'order' => $order
      ]);
    } catch (\Exception $e) {
      return $this->sendResponse([
        'order' => $order
      ]);
    }
  }

  /**
   * Edit entity (show UI)
   *
   * @param EditOrderRequest $request
   */
  public function edit(EditOrderRequest $request)
  {
    $order = Apiato::call('Order@GetOrderByIdAction', [$request]);

    // ..
  }

  /**
   * Update a given entity
   *
   * @param UpdateOrderRequest $request
   */
  public function update(UpdateOrderRequest $request)
  {
    $order = Apiato::call('Order@UpdateOrderAction', [$request]);

    // ..
  }

  /**
   * Delete a given entity
   *
   * @param DeleteOrderRequest $request
   */
  public function delete(DeleteOrderRequest $request)
  {
    $result = Apiato::call('Order@DeleteOrderAction', [$request]);

    // ..
  }
}
