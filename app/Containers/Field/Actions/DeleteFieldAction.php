<?php

namespace App\Containers\Field\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteFieldAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Field@DeleteFieldTask', [$request->id]);
    }
}
