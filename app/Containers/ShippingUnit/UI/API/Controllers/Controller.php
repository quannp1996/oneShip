<?php

namespace App\Containers\ShippingUnit\UI\API\Controllers;

use App\Ship\Parents\Controllers\ApiController;
use App\Containers\ShippingUnit\Actions\GetAllShippingUnitsAction;
use App\Containers\ShippingUnit\UI\API\Transformers\ShippingUnitTransformer;
use App\Containers\ShippingUnit\UI\API\Requests\GetAllShippingUnitsRequest;

/**
 * Class Controller
 *
 * @package App\Containers\ShippingUnit\UI\API\Controllers
 */
class Controller extends ApiController
{
    public function getAllShippingUnits(GetAllShippingUnitsRequest $request, GetAllShippingUnitsAction $getAllShippingUnitsAction)
    {
        $shippingunits = $getAllShippingUnitsAction->run($request->all(), $request->get('with', []));
        return $this->transform($shippingunits, ShippingUnitTransformer::class);
    }
}
