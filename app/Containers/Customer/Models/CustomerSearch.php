<?php

namespace App\Containers\Customer\Models;

use App\Ship\Parents\Models\Model;

class CustomerSearch extends Model
{

    protected $table = 'customer_search';
    protected $guarded = [

    ];
    protected $fillable = [
      'customer_id',
      'key_search',
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
    protected $resourceKey = 'customersearch';

    public function customer() {
      return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
} // End class
