<?php

namespace App\Containers\ShippingUnit\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\ShippingUnit\Tasks\CreateShippingConstTask;

class CreateShippingConstAction extends Action
{
    public function run(array $shippingConstData = [])
    {
        $data = array_filter($shippingConstData, function($item){
            return in_array($item, [
                'dev_mode', 'status', 'title', 'type', 'security', 'image', 'vung'
            ]);
        }, ARRAY_FILTER_USE_KEY);
        $shippingConst = app(CreateShippingConstTask::class)->run($data);
        return $shippingConst;
    }
}
