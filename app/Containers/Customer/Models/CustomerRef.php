<?php

namespace App\Containers\Customer\Models;

use App\Ship\Parents\Models\Model;
use App\Containers\Customer\Models\Customer;
use App\Containers\BaseContainer\Enums\BaseEnum;

class CustomerRef extends Model
{
    protected $table = 'customer_ref';
    protected $fillable = [
        'customer_id',
        'ref_code'
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
    protected $resourceKey = 'customerrefs';

    public function checkCustomerRefExist($ref_code, $customerId)
    {
        $count = $this->where('ref_code', $ref_code)->where('customer_id', $customerId)->count();
        return $count > 0 ? true : false;
    }

    public function customerReferral()
    {
      return $this->belongsTo(Customer::class, 'ref_code', 'ref_code');
    }

    public function customerReferraled()
    {
      return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

}
