<?php

namespace App\Containers\Field\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class FindFieldByIdAction extends Action
{
    public function run(Request $request)
    {
        $field = Apiato::call('Field@FindFieldByIdTask', [$request->id]);

        return $field;
    }
}
