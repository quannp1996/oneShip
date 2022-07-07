<?php

namespace App\Containers\Customer\Models;

use App\Ship\Parents\Models\Model;
use App\Containers\Location\Models\City;
use App\Containers\Location\Models\Ward;
use App\Containers\Location\Models\District;

class CustomerAddressBook extends Model
{
    protected $table = 'customer_address';

    protected $fillable = ['fullname', 'phone', 'email', 'province_id', 'district_id', 'ward_id', 'village', 'zipcode', 'address1', 'address2', 'type', 'is_default', 'customerID'];

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
        return $this->hasOne(City::class, 'code', 'province_id');
    }

    public function district()
    {
        return $this->hasOne(District::class, 'code', 'district_id');
    }

    public function ward()
    {
        return $this->hasOne(Ward::class, 'code', 'ward_id');
    }

    public function generateAddress() :string
    {   
        $arrayReturn = [];
        if ($this->relationLoaded('ward') && !empty($this->ward)) $arrayReturn[] = $this->ward->name;
        if ($this->relationLoaded('district') && !empty($this->district)) $arrayReturn[] = $this->district->name;
        if ($this->relationLoaded('province') && !empty($this->province)) $arrayReturn[] = $this->province->name;
        return $this->address1. ' - '. implode(', ', $arrayReturn);
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function($model) {
            $model->type = (int) $model->type;
        });
    }
}
