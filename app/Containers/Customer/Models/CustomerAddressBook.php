<?php

namespace App\Containers\Customer\Models;

use App\Containers\Location\Models\City;
use App\Containers\Location\Models\District;
use App\Containers\Location\Models\Ward;
use App\Ship\Parents\Models\Model;

class CustomerAddressBook extends Model
{
    protected $table = 'customer_address';

    protected $fillable = [
    ];

    protected $attributes = [];

    protected $hidden = [];

    protected $casts = [];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'customer_address';

    public function province()
    {
        return $this->hasOne(City::class, 'id', 'province_id');
    }

    public function district()
    {
        return $this->hasOne(District::class, 'id', 'district_id');
    }

    public function ward()
    {
        return $this->hasOne(Ward::class, 'id', 'ward_id');
    }
}
