<?php

namespace App\Containers\Location\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllWardsAction extends Action
{
    public function run(bool $hasPagination, int $limit = 20, string $orderBy = 'id desc', array $withData = [], array $condition = [])
    {
        $wards = Apiato::call('Location@GetAllWardsTask', [$hasPagination, $limit, $orderBy], [
            [
                'filterLocation' => [$condition],
            ],
            [
                'withData' => [$withData]
            ]
        ]);
        return $wards;
    }
}
