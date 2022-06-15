<?php

namespace App\Containers\Location\Models;

class Ward extends Location
{
    protected $table = '_geovnward';

    protected $fillable = [
        'name',
        'code',
        'district_id',
        'province_id'
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = '_geovnward';

    public function district(){
        return $this->hasOne(District::class, 'code', 'district_id');
    }

    public function province(){
        return $this->hasOne(City::class, 'code', 'province_id');
    }
}
