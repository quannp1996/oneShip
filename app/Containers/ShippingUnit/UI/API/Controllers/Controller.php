<?php

namespace App\Containers\ShippingUnit\UI\API\Controllers;

use App\Containers\BaseContainer\UI\WEB\Controllers\BaseApiFrontController;
use App\Ship\Parents\Controllers\ApiController;
use App\Containers\ShippingUnit\Actions\GetAllShippingUnitsAction;
use App\Containers\ShippingUnit\UI\API\Controllers\Features\CaculateFee;
use App\Containers\ShippingUnit\UI\API\Controllers\Features\TraitCaculateFee;
use App\Containers\ShippingUnit\UI\API\Transformers\ShippingUnitTransformer;
use App\Containers\ShippingUnit\UI\API\Requests\GetAllShippingUnitsRequest;

/**
 * Class Controller
 *
 * @package App\Containers\ShippingUnit\UI\API\Controllers
 */
class Controller extends BaseApiFrontController
{
    use TraitCaculateFee;

    public function getAllShippingUnits(GetAllShippingUnitsRequest $request, GetAllShippingUnitsAction $getAllShippingUnitsAction)
    {
        $shippingunits = $getAllShippingUnitsAction->run($request->all(), $request->get('with', []));
        return $this->transform($shippingunits, ShippingUnitTransformer::class);
    }
}
