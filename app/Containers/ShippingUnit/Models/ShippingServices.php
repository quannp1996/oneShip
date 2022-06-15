<?php

namespace App\Containers\ShippingUnit\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class ShippingServices extends Model
{

    protected $tables = 'shipping_services';
    public $appends = ['id'];
    protected $fillable = [
        'name', 'price', 'shippingID', 'mode'
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
    protected $resourceKey = 'shippingservices';

    public function getResourceKey()
    {
        return $this->resourceKey;
    }
}
