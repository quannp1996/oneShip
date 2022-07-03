<?php

namespace App\Containers\Order\UI\WEB\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\Facades\FunctionLib;
use App\Ship\Parents\Controllers\WebController;
use App\Ship\Parents\Controllers\AdminController;
use App\Containers\Order\UI\WEB\Requests\EditOrderRequest;
use App\Containers\Order\UI\WEB\Requests\StoreOrderRequest;
use App\Containers\Order\UI\WEB\Requests\CreateOrderRequest;
use App\Containers\Order\UI\WEB\Requests\DeleteOrderRequest;
use App\Containers\Order\UI\WEB\Requests\UpdateOrderRequest;
use App\Containers\Order\UI\WEB\Requests\GetAllOrdersRequest;
use App\Containers\Order\UI\WEB\Requests\FindOrderByIdRequest;
use App\Containers\Order\UI\WEB\Requests\GetAllOrderLogsRequest;

/**
 * Class OrderLogController
 *
 * @package App\Containers\Order\UI\WEB\Controllers
 */
class OrderLogController extends AdminController
{
    public function __construct()
    {
      if (in_array(FunctionLib::getActionController(), ['logs', 'edit', 'show', 'update', 'delete'])) {
        $this->dontUseShareData = true;
      }

      parent::__construct();
    }

    /**
     * Show all entities
     *
     * @param GetAllOrdersRequest $request
     */
    public function logs(GetAllOrderLogsRequest $request)
    {
      $dataTransporter = $request->toTransporter();

      $order = Apiato::call('Order@FindOrderByIdAction', [
        $request->id,['notes']
      ]);
      // dd($order);
      $logs = Apiato::call('Order@GetAllOrderLogsAction', [$dataTransporter]);
      $users = collect([]);
      if ($dataTransporter->user_id) {
        $users = Apiato::call('User@GetAllUserNoLimitAction', [
          [
            ['id', '=', $dataTransporter->user_id],
          ],

          ['id', 'name', 'email']
        ]);
      }
      return view('order::logs', [
        'order' => $order,
        'logs' => $logs,
        'input' => $request->all(),
        'orderActions' => config('order-container.order-action'),
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
        $order = Apiato::call('Order@FindOrderByIdAction', [$request->id]);

        // ..
    }

    /**
     * Create entity (show UI)
     *
     * @param CreateOrderRequest $request
     */
    public function create(CreateOrderRequest $request)
    {
        // ..
    }

    /**
     * Add a new entity
     *
     * @param StoreOrderRequest $request
     */
    public function store(StoreOrderRequest $request)
    {
        $order = Apiato::call('Order@CreateOrderAction', [$request]);

        // ..
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
