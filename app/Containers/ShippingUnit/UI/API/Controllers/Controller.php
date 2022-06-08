<?php

namespace App\Containers\ShippingUnit\UI\API\Controllers;

use App\Containers\ShippingUnit\UI\API\Requests\CreateShippingUnitRequest;
use App\Containers\ShippingUnit\UI\API\Requests\DeleteShippingUnitRequest;
use App\Containers\ShippingUnit\UI\API\Requests\GetAllShippingUnitsRequest;
use App\Containers\ShippingUnit\UI\API\Requests\FindShippingUnitByIdRequest;
use App\Containers\ShippingUnit\UI\API\Requests\UpdateShippingUnitRequest;
use App\Containers\ShippingUnit\UI\API\Transformers\ShippingUnitTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\ShippingUnit\Actions\GetAllShippingUnitsAction;

/**
 * Class Controller
 *
 * @package App\Containers\ShippingUnit\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateShippingUnitRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createShippingUnit(CreateShippingUnitRequest $request)
    {
        $shippingunit = Apiato::call('ShippingUnit@CreateShippingUnitAction', [$request]);

        return $this->created($this->transform($shippingunit, ShippingUnitTransformer::class));
    }

    /**
     * @param FindShippingUnitByIdRequest $request
     * @return array
     */
    public function findShippingUnitById(FindShippingUnitByIdRequest $request)
    {
        $shippingunit = Apiato::call('ShippingUnit@FindShippingUnitByIdAction', [$request]);

        return $this->transform($shippingunit, ShippingUnitTransformer::class);
    }

    /**
     * @param GetAllShippingUnitsRequest $request
     * @return array
     */
    public function getAllShippingUnits(GetAllShippingUnitsRequest $request, GetAllShippingUnitsAction $getAllShippingUnitsAction)
    {
        $shippingunits = $getAllShippingUnitsAction->run($request->all());
        return $this->transform($shippingunits, ShippingUnitTransformer::class);
    }

    /**
     * @param UpdateShippingUnitRequest $request
     * @return array
     */
    public function updateShippingUnit(UpdateShippingUnitRequest $request)
    {
        $shippingunit = Apiato::call('ShippingUnit@UpdateShippingUnitAction', [$request]);

        return $this->transform($shippingunit, ShippingUnitTransformer::class);
    }

    /**
     * @param DeleteShippingUnitRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteShippingUnit(DeleteShippingUnitRequest $request)
    {
        Apiato::call('ShippingUnit@DeleteShippingUnitAction', [$request]);

        return $this->noContent();
    }
}
