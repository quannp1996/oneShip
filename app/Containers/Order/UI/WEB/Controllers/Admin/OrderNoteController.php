<?php

namespace App\Containers\Order\UI\WEB\Controllers;

use Apiato\Core\Foundation\FunctionLib;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Controllers\WebController;
use App\Ship\Parents\Controllers\AdminController;
use App\Containers\Order\UI\WEB\Requests\EditOrderRequest;
use App\Containers\Order\UI\WEB\Requests\StoreOrderNoteRequest;
use App\Containers\Order\UI\WEB\Requests\CreateOrderRequest;
use App\Containers\Order\UI\WEB\Requests\DeleteOrderRequest;
use App\Containers\Order\UI\WEB\Requests\UpdateOrderRequest;
use App\Containers\Order\UI\WEB\Requests\GetAllOrdersRequest;
use App\Containers\Order\UI\WEB\Requests\FindOrderByIdRequest;
use App\Containers\Order\UI\WEB\Requests\CreateOrderNoteRequest;
use App\Containers\Order\UI\WEB\Requests\GetAllOrderNoteRequest;

/**
 * Class OrderNoteController
 *
 * @package App\Containers\Order\UI\WEB\Controllers
 */
class OrderNoteController extends AdminController
{
  public function __construct()
  {
    if (in_array(FunctionLib::getActionController(), ['create', 'index', 'store'])) {
      $this->dontUseShareData = true;
    }

    parent::__construct();
  }

  /**
   * Show all entities
   *
   * @param GetAllOrderNoteRequest $request
   */
  public function index(GetAllOrderNoteRequest $request)
  {
    $transporter = $request->toTransporter();
    $orderNotes = Apiato::call('Order@GetAllOrderNoteAction', [$transporter]);

    $order = Apiato::call('Order@FindOrderByIdAction', [
      $request->id,
      [],
      ['id', 'code']
    ]);
    return view('order::note.index', [
      'orderNotes' => $orderNotes,
      'order' => $order,
      'input' => $request->all()
    ]);
  }

  /**
   * Show one entity
   *
   * @param FindOrderByIdRequest $request
   */
  public function show(FindOrderByIdRequest $request)
  {
    $order = Apiato::call('Order@FindOrderByIdAction', [$request->id]);

    // ..
  }

  /**
   * Create entity (show UI)
   *
   * @param CreateOrderNoteRequest $request
   */
  public function create(CreateOrderNoteRequest $request)
  {
    $order = Apiato::call('Order@FindOrderByIdAction', [
      $request->id,
      [],
      ['id', 'code']
    ]);
    return view('order::note.create', [
      'order' => $order,
      'ordersAction' => config('order-container.order-action'),
      'input' => $request->all()
    ]);
  }

  /**
   * Add a new entity
   *
   * @param StoreOrderNoteRequest $request
   */
  public function store(StoreOrderNoteRequest $request)
  {
    $transporter = $request->toTransporter();
    $orderNote = Apiato::call('Order@StoreOrderNoteAction', [$transporter]);
    return redirect()->back()->with([
      'flash_message' => 'Tạo ghi chú thành công',
      'flash_level' => 'success',
      'objectData' => $orderNote,
      'viewRender' => 'order::note.note-item',
      'itemAppend' => '#list-order-note',
      'itemEach' => '#list-order-note .order-log-item',
    ]);
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
