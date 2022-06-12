<?php

namespace App\Containers\Location\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class DeleteCityAction extends Action
{
    public function run(int $cityID)
    {
        $result = Apiato::call('Location@DeleteCityTask', [ $cityID ]);

        $this->clearCache();

        return $result;
    }
}
