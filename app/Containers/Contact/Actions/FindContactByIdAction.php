<?php

namespace App\Containers\Contact\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindContactByIdAction extends Action
{
    public function run(Request $request)
    {
        $contact = Apiato::call('Contact@FindContactByIdTask', [$request->id]);

        return $contact;
    }
}
