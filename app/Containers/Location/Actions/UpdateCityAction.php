<?php

namespace App\Containers\Location\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class UpdateCityAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'name',
            'code'
        ]);
        $location = Apiato::call('Location@UpdateCityTask', [$request->id, $data]);

        $this->clearCache();

        return $location;
    }
}
