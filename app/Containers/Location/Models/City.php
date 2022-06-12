<?php

namespace App\Containers\Location\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class City extends Model
{
    protected $table = '_geovnprovince';

    protected $fillable = [
        'name',
        'code'
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    // protected $dates = [
    //     'created_at',
    //     'updated_at',
    // ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = '_geovnprovince';
}
