<?php

namespace App\Containers\Customer\Models;

use App\Ship\Parents\Models\Model;

class CustomerGroupConnect extends Model
{
    protected $table = 'customer_group_connect';

    protected $guarded = [

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
    protected $resourceKey = 'customergroupdescs';
}
