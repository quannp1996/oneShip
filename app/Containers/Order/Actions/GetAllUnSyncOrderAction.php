<?php

namespace App\Containers\Order\Actions;

use App\Ship\Parents\Actions\Action;
use App\Containers\Order\Tasks\GetAllUnSyncOrderTask;
use Illuminate\Support\Facades\DB;

class GetAllUnSyncOrderAction extends Action
{
    public function run(array $with=[], array $column=['*'])
    {
        $orders = app(GetAllUnSyncOrderTask::class)->with($with)->selectFields($column)->run();
        return $orders;
    }
} // End class
