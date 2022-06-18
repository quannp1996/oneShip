<?php

namespace App\Containers\Location\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class UpdateDistrictAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'name',
            'vung',
            'noithanh'
        ]);
        
        $location = Apiato::call('Location@UpdateDistrictTask', [$request->id, $data]);

        return $location;
    }
}
