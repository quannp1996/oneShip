<?php

namespace App\Containers\Location\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Support\Facades\Cache;

class UpdateCityAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'name',
            'vungmien',
        ]);
        $data['disabled'] = !empty($request->disabled) ? $request->disabled : [];
        $location = Apiato::call('Location@UpdateCityTask', [$request->id, $data]);
        return $location;
    }
}
