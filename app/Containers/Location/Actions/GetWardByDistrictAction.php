<?php

namespace App\Containers\Location\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\DB;

class GetWardByDistrictAction extends Action
{
    public function run(int $districtID)
    {
       return Apiato::call('Location@GetWardByDistrictTask', [
            $districtID
       ]);
    }
}
