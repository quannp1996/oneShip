<?php

namespace App\Containers\Location\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\DB;

class GetDistrictByCityAction extends Action
{
    public function run(int $cityID = 0)
    {
        return Apiato::call('Location@GetDistrictByCityTask', [
            $cityID
        ]);
    }
}
