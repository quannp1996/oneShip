<?php

namespace App\Containers\ShippingUnit\UI\WEB\Controllers\Admin\Features;

use App\Containers\ShippingUnit\Actions\CreateShippingConstAction;
use App\Containers\ShippingUnit\Actions\UpdateShippingConstAction;
use App\Containers\ShippingUnit\UI\API\Requests\SaveShippingConstRequest;
use App\Containers\ShippingUnit\UI\API\Transformers\ShippingConstTransformer;

/**
 * Trait ShippingCost
 */
trait ShippingConst
{
    
    public function saveShippingConst(SaveShippingConstRequest $request, CreateShippingConstAction $createShippingConstAction)
    {
        $shippingConst = $createShippingConstAction->run($request->all());
        return $this->transform($shippingConst, ShippingConstTransformer::class);
    }

    public function updateShippingConst(SaveShippingConstRequest $request, UpdateShippingConstAction $updateShippingConstAction)
    {
        $shippingConst = $updateShippingConstAction->run($request->all());
        return $this->transform($shippingConst, ShippingConstTransformer::class);
    }
}
