<?php

namespace App\Containers\Location\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class GetWardByIDAction extends Action
{
    public function run(int $ward_id = 0)
    {
        return $this->remember(function () use ($ward_id) {
            $ward = Apiato::call('Location@GetWardByIDTask', [$ward_id]);
            return $ward;
        });
    }
}