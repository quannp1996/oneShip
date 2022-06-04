<?php

namespace App\Containers\Customer\Models;

use App\Ship\Parents\Models\Model;
use App\Containers\Order\Models\Order;
use App\Containers\Customer\Models\Customer;
use App\Containers\Customer\Models\CustomerRef;

class CustomerRefRevenue extends Model
{
    protected $table = 'customer_ref_revenue';
    protected $fillable = [
        'customer_ref_id',
        'customer_id',
        'order_id',
        'point',
        'status'
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
    protected $resourceKey = 'customerrefrevenues';

    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function customer(){
        return $this->belongsTo(customer::class, 'customer_id', 'id');
    }

    public function countOrderByRefId($customer_ref_id)
    {
        $count = $this->where('customer_ref_id', $customer_ref_id)->count();
        return $count;
    }

    public function customerRef(){
        return $this->belongsTo(CustomerRef::class, 'customer_ref_id', 'id');
    }
}


