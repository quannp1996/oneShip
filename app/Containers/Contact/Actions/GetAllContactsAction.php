<?php

namespace App\Containers\Contact\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Contact\Tasks\GetAllContactsTask;

class GetAllContactsAction extends Action
{
    public function run(Request $request)
    {
        $contacts = app(GetAllContactsTask::class)->filter($request->all())->run();
        return $contacts;
    }
}
