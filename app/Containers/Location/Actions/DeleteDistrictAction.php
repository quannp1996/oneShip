<?php

namespace App\Containers\Location\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteDistrictAction extends Action
{
    public function run(int $districtID)
    {
        $result = Apiato::call('Location@DeleteDistrictTask', [$districtID]);

        return $result;
    }
}
