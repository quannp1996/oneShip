<?php

namespace App\Containers\ShippingUnit\UI\WEB\Controllers;

use App\Containers\ShippingUnit\UI\WEB\Requests\CreateShippingUnitRequest;
use App\Containers\ShippingUnit\UI\WEB\Requests\DeleteShippingUnitRequest;
use App\Containers\ShippingUnit\UI\WEB\Requests\GetAllShippingUnitsRequest;
use App\Containers\ShippingUnit\UI\WEB\Requests\FindShippingUnitByIdRequest;
use App\Containers\ShippingUnit\UI\WEB\Requests\UpdateShippingUnitRequest;
use App\Containers\ShippingUnit\UI\WEB\Requests\StoreShippingUnitRequest;
use App\Containers\ShippingUnit\UI\WEB\Requests\EditShippingUnitRequest;
use App\Ship\Parents\Controllers\WebController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\ShippingUnit\UI\WEB\Controllers
 */
class Controller extends WebController
{
    /**
     * Show all entities
     *
     * @param GetAllShippingUnitsRequest $request
     */
    public function index(GetAllShippingUnitsRequest $request)
    {
        $shippingunits = Apiato::call('ShippingUnit@GetAllShippingUnitsAction', [$request]);

        // ..
    }

    /**
     * Show one entity
     *
     * @param FindShippingUnitByIdRequest $request
     */
    public function show(FindShippingUnitByIdRequest $request)
    {
        $shippingunit = Apiato::call('ShippingUnit@FindShippingUnitByIdAction', [$request]);

        // ..
    }

    /**
     * Create entity (show UI)
     *
     * @param CreateShippingUnitRequest $request
     */
    public function create(CreateShippingUnitRequest $request)
    {
        // ..
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
