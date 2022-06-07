<?php

namespace App\Containers\Customer\Models;

use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerGroup extends Model
{
    use SoftDeletes;

    protected $table = 'customer_group';
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
    protected $resourceKey = 'customergroups';

    public function customer() {
      return $this->belongsToMany(Customer::class, app(CustomerGroupConnect::class)->getTable(), 'customer_group_id', 'customer_id');
    }
} // End class
