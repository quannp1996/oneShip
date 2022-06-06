<?php

namespace App\Containers\ShippingUnit\Actions;

use Illuminate\Support\Arr;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class CreateShippingUnitAction extends Action
{
    public function run(array $shippingData = [])
    {
        $data = array_filter($shippingData, function($item){
            return in_array($item, [
                'dev_mode', 'status', 'title', 'type', 'security', 'image'
            ]);
        }, ARRAY_FILTER_USE_KEY);
        $shippingunit = Apiato::call('ShippingUnit@CreateShippingUnitTask', [$data]);
        return $shippingunit;
    }
}
