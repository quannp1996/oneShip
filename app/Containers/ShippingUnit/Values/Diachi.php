<?php

namespace App\Containers\ShippingUnit\Values;

use App\Containers\Location\Actions\GetAllCitiesWithCacheAction;
use App\Containers\Location\Actions\GetAllDistrictsWithCacheAction;
use App\Containers\Location\Models\City;
use App\Containers\Location\Models\District;
use App\Ship\Parents\Values\Value;

class Diachi extends Value
{
    public City $province;

    public District $district;

    public $ward;

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'diachi';

    public function __construct(array $diachi = [])
    {
        $allCities = app(GetAllCitiesWithCacheAction::class)->run();
        $allDistricts = app(GetAllDistrictsWithCacheAction::class)->run();
        $this->province = $allCities->filter(function($item) use($diachi){
            return $item->code == $diachi['province'];
        })->first();
        $this->district = $allDistricts->filter(function($item) use($diachi){
            return $item->code == $diachi['district'];
        })->first();
        $this->ward = $diachi['ward'];
    }
}   
