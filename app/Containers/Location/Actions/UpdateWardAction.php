<?php

namespace App\Containers\Location\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class UpdateWardAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'name', 'district_id'
        ]);
        $location = Apiato::call('Location@UpdateWardTask', [$request->id, $data]);

        return $location;
    }
}
