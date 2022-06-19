<?php

namespace App\Containers\Location\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Support\Facades\Cache;

class GetAllCitiesWithCacheAction extends Action
{
    public function run()
    {
        $cities = Cache::get('list_cities');
        if(empty($cities)){
            $cities = Apiato::call('Location@GetAllCitiesTask', [false, 100000, 'id desc']);
            Cache::put('list_cities', $cities);
        }
        return $cities;
    }
}
