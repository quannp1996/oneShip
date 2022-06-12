<?php

namespace App\Containers\Location\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class CreateCityAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'name',
            'code'
        ]);
        $location = Apiato::call('Location@CreateCityTask', [$data]);

        $this->clearCache();

        return $location;
    }
}
