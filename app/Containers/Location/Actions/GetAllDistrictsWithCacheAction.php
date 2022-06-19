<?php

namespace App\Containers\Location\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use Illuminate\Support\Facades\Cache;

class GetAllDistrictsWithCacheAction extends Action
{
    public function run()
    {
        $districts = Cache::get('list_districts');
        if(empty($districts)){
            $districts = Apiato::call('Location@GetAllDistrictsTask', [false, 1000, 'id desc']);
            Cache::put('list_districts', $districts);
        }
        return $districts;
    }
}
