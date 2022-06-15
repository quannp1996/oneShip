<?php

namespace App\Containers\ShippingUnit\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\ShippingUnit\Tasks\InsertShippingServiceTask;

class UpdateShippingUnitAction extends Action
{
    public function run(array $shippingData = [])
    {
        $data = array_filter($shippingData, function($item){
            return in_array($item, [
                'dev_mode', 'status', 'title', 'type', 'security', 'image'
            ]);
        }, ARRAY_FILTER_USE_KEY);
        $services = $shippingData['services'] ?? [];
        $services = array_filter($services, function($item) {
            return $item['name'] != '' && $item['price'] != '';
        });
        $shippingUnit = Apiato::call('ShippingUnit@UpdateShippingUnitTask', [$shippingData['id'], $data]);
        if(!empty($services)){
            foreach($services AS &$service){
                $service['shippingID'] = $shippingUnit->id;
            }
            app(InsertShippingServiceTask::class)->run($services, $shippingUnit->id);
        }
        return $shippingUnit;
    }
}
