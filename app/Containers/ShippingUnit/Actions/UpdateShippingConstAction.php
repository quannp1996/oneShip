<?php

namespace App\Containers\ShippingUnit\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\ShippingUnit\Tasks\UpdateShippingConstTask;

class UpdateShippingConstAction extends Action
{
    public function run(array $shippingData = [])
    {
        $data = array_filter($shippingData, function($item){
            return in_array($item, [
                'title', 'items', 'shippingUnitID', 'is_default'
            ]);
        }, ARRAY_FILTER_USE_KEY);
        $shippingconst = app(UpdateShippingConstTask::class)->run($shippingData['id'], $data);
        return $shippingconst;
    }
}
