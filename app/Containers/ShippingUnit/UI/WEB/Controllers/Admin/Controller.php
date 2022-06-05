<?php

namespace App\Containers\ShippingUnit\UI\WEB\Controllers\Admin;

use App\Containers\ShippingUnit\UI\WEB\Requests\CreateShippingUnitRequest;
use App\Containers\ShippingUnit\UI\WEB\Requests\DeleteShippingUnitRequest;
use App\Containers\ShippingUnit\UI\WEB\Requests\GetAllShippingUnitsRequest;
use App\Containers\ShippingUnit\UI\WEB\Requests\FindShippingUnitByIdRequest;
use App\Containers\ShippingUnit\UI\WEB\Requests\UpdateShippingUnitRequest;
use App\Containers\ShippingUnit\UI\WEB\Requests\StoreShippingUnitRequest;
use App\Containers\ShippingUnit\UI\WEB\Requests\EditShippingUnitRequest;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\BaseContainer\Actions\CreateBreadcrumbAction;
use App\Containers\ShippingUnit\Actions\GetAllShippingUnitsAction;
use App\Containers\ShippingUnit\Enums\EnumShipping;
use App\Ship\Parents\Controllers\AdminController;

/**
 * Class Controller
 *
 * @package App\Containers\ShippingUnit\UI\WEB\Controllers
 */
class Controller extends AdminController
{
    public function __construct()
    {
        $this->title = 'Đơn vị vận chuyển';
        view()->share('list_type', EnumShipping::LISTTYPE);
        parent::__construct();
    }
    /**
     * Show all entities
     *
     * @param GetAllShippingUnitsRequest $request
     */
    public function index(GetAllShippingUnitsRequest $request, GetAllShippingUnitsAction $getAllShippingUnitsAction)
    {
        app(CreateBreadcrumbAction::class)->run('lists', $this->title);
        $shippingUnits = $getAllShippingUnitsAction->run($request->all());
        return view('shippingunit::admin.index', [
            'shippingUnits' => $shippingUnits,
            'searchData' => $request
        ]);
    }

    /**
     * Show one entity
     *
     * @param FindShippingUnitByIdRequest $request
     */
    public function show(FindShippingUnitByIdRequest $request)
    {
        $shippingunit = Apiato::call('ShippingUnit@FindShippingUnitByIdAction', [$request]);
    }

    /**
     * Create entity (show UI)
     *
     * @param CreateShippingUnitRequest $request
     */
    public function create(CreateShippingUnitRequest $request)
    {
        app(CreateBreadcrumbAction::class)->run('add', $this->title, 'admin_shipping_unit_index');
        return view('shippingunit::admin.edit');
    }

    /**
     * Add a new entity
     *
     * @param StoreShippingUnitRequest $request
     */
    public function store(StoreShippingUnitRequest $request)
    {
        $shippingunit = Apiato::call('ShippingUnit@CreateShippingUnitAction', [$request]);

        // ..
    }

    /**
     * Edit entity (show UI)
     *
     * @param EditShippingUnitRequest $request
     */
    public function edit(EditShippingUnitRequest $request)
    {
        $shippingunit = Apiato::call('ShippingUnit@GetShippingUnitByIdAction', [$request]);

        // ..
    }

    /**
     * Update a given entity
     *
     * @param UpdateShippingUnitRequest $request
     */
    public function update(UpdateShippingUnitRequest $request)
    {
        $shippingunit = Apiato::call('ShippingUnit@UpdateShippingUnitAction', [$request]);

        // ..
    }

    /**
     * Delete a given entity
     *
     * @param DeleteShippingUnitRequest $request
     */
    public function delete(DeleteShippingUnitRequest $request)
    {
         $result = Apiato::call('ShippingUnit@DeleteShippingUnitAction', [$request]);

         // ..
    }
}
