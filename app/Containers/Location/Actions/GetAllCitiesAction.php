<?php

namespace App\Containers\Location\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllCitiesAction extends Action
{
    public function run(bool $hasPagination = true, int $limit = 20, string $orderBy = 'id desc', array $withData = [], array $condition = [])
    {
        // return $this->remember(function () use ($hasPagination,$limit,$orderBy, $withData, $condition) {
            $cities = Apiato::call('Location@GetAllCitiesTask', [$hasPagination,$limit,$orderBy], [
                [
                    'filterLocation' => [$condition]
                ],
                [
                    'withData' => [$withData],
                ]
            ]);
            return $cities;
        // }, 'list_city');
    }
}
