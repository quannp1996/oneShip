<?php

namespace App\Containers\Order\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

class GetAllOrderLogsAction extends Action
{
    public function run($dataTransporter)
    {
        $orderlogs = Apiato::call('Order@GetAllOrderLogsTask', [], [
          [
            'filterOrderLogs' => [ $dataTransporter ]
          ]
        ]);

        return $orderlogs;
    }
}
