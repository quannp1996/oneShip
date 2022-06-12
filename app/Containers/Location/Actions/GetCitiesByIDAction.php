<?php

namespace App\Containers\Location\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class GetCitiesByIDAction extends Action
{
    public function run(int $cites_id = 0)
    {
        return $this->remember(function () use ($cites_id) {
            $cities = Apiato::call('Location@GetCitiesByIDTask', [$cites_id]);
            return $cities;
        });
    }
}