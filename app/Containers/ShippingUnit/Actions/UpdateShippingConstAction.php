<?php

namespace App\Containers\ShippingUnit\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\ShippingUnit\Tasks\UpdateShippingConstTask;

class UpdateShippingConstAction extends Action
{
    public function run(array $shippingData = [], $id = null)
    {
        $data = array_filter($shippingData, function($item){
            return in_array($item, [
                'title', 'items', 'shippingUnitID', 'is_default', 'overweight'
            ]);
        }, ARRAY_FILTER_USE_KEY);
        $shippingconst = app(UpdateShippingConstTask::class)->run($id, $data);
        return $shippingconst;
    }
}
