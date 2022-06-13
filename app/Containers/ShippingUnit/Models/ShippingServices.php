<?php

namespace App\Containers\ShippingUnit\Models;

use Apiato\Core\Foundation\ImageURL;
use App\Containers\ShippingUnit\Enums\EnumShipping;
use Jenssegers\Mongodb\Eloquent\Model;

class ShippingServices extends Model
{

    protected $tables = 'shippingconst';
    public $appends = ['id'];
    protected $fillable = [
        'title', 'is_percent', 'value', 'sort_order'
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
