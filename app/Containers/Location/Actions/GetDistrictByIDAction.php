<?php

namespace App\Containers\Location\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class GetDistrictByIDAction extends Action
{
    public function run(int $district_id = 0)
    {
        return $this->remember(function () use ($district_id) {
            $district = Apiato::call('Location@GetDistrictByIDTask', [$district_id]);
            return $district;
        });
    }
}