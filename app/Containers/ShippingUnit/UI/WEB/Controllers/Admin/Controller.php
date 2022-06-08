<?php

namespace App\Containers\ShippingUnit\UI\WEB\Controllers\Admin;

use App\Containers\ShippingUnit\UI\WEB\Requests\CreateShippingUnitRequest;
use App\Containers\ShippingUnit\UI\WEB\Requests\DeleteShippingUnitRequest;
use App\Containers\ShippingUnit\UI\WEB\Requests\GetAllShippingUnitsRequest;
use App\Containers\ShippingUnit\UI\WEB\Requests\FindShippingUnitByIdRequest;
use App\Containers\ShippingUnit\UI\WEB\Requests\UpdateShippingUnitRequest;
use App\Containers\ShippingUnit\UI\WEB\Requests\StoreShippingUnitRequest;
use App\Containers\ShippingUnit\UI\WEB\Requests\EditShippingUnitRequest;
use App\Containers\BaseContainer\Actions\CreateBreadcrumbAction;
use App\Containers\ShippingUnit\Actions\GetAllShippingUnitsAction;
use App\Containers\ShippingUnit\Enums\EnumShipping;
use App\Ship\Parents\Controllers\AdminController;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\ShippingUnit\Actions\CreateShippingUnitAction;
use App\Containers\ShippingUnit\Actions\FindShippingUnitByIdAction;
use App\Containers\ShippingUnit\Actions\UpdateShippingUnitAction;

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
        $this->actions = [
            'update' => UpdateShippingUnitAction::class,
            'create' => CreateShippingUnitAction::class
        ];
        $this->routes = [
            'edit' => 'admin_shipping_unit_index',
            'list' => 'admin_shipping_unit_index',
            'update' => 'admin_shipping_unit_edit'
        ];
        $this->imageField = 'image';
        $this->imageKey = 'shipping';
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
        $this->editMode = false;
        return $this->save($request);
    }

    /**
     * Edit entity (show UI)
     *
     * @param EditShippingUnitRequest $request
     */
    public function edit(EditShippingUnitRequest $request, FindShippingUnitByIdAction $findShippingUnitByIdAction)
    {
        $shippingunit = $findShippingUnitByIdAction->run($request->id);
        return view('shippingunit::admin.edit', [
            'data' => $shippingunit
        ]);
    }

    /**
     * Update a given entity
     *
     * @param UpdateShippingUnitRequest $request
     */
    public function update(UpdateShippingUnitRequest $request)
    {
        $this->editMode = true;
        return $this->save($request);
    }

    /**
     * Delete a given entity
     *
     * @param DeleteShippingUnitRequest $request
     */
    public function delete(DeleteShippingUnitRequest $request)
    {
         $result = Apiato::call('ShippingUnit@DeleteShippingUnitAction', [$request]);
    }

    public function beforeSave($request, &$tranporter)
    {
        $extra_data = $request->extra_data;
        $security = [];
        foreach($extra_data AS $data) {
            $security[$data['key']] = $data['value'];
        }
        $tranporter['security'] = json_encode($security);
        parent::beforeSave($request, $tranporter);
    }
}
