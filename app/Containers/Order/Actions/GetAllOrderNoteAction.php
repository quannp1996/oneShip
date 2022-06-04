<?php

namespace App\Containers\Order\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Order\Tasks\GetAllOrderNotesTask;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Arr;

class GetAllOrderNoteAction extends Action
{
    public function run(DataTransporter $dataTransporter, array $with=[])
    {
        $where = Arr::only($dataTransporter->toArray(), 'order_id');
        $ordernotes = app(GetAllOrderNotesTask::class)->with($with)->run($where);

        return $ordernotes;
    }
}
