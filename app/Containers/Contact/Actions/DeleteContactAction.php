<?php

namespace App\Containers\Contact\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteContactAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Contact@DeleteContactTask', [$request->id]);
    }
}
