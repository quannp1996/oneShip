<?php

namespace App\Containers\Location\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllDistrictsAction extends Action
{
    public function run(bool $hasPgination, int $limit = 20, string $orderBy = 'id desc', array $withData = [], array $condition = [])
    {
        $districts = Apiato::call('Location@GetAllDistrictsTask', [$hasPgination, $limit, $orderBy], [
            [
                'filterLocation' => [$condition],
            ],
            [
                'withData' => [$withData]
            ]
        ]);
        return $districts;
    }
}
