<?php

namespace App\Containers\Customer\Models;

use App\Ship\Parents\Models\Model;
use App\Containers\Product\Models\Product;

class CustomerWishList extends Model
{
    protected $table = 'customer_wish_list';

    protected $fillable = [
        'customer_id', 'product_id', 'type'
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
    protected $resourceKey = 'customer_wish_list';

    public function product()
    {
      return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function checkProductExist($product_id, $customerId){
        $count=$this->where('product_id',$product_id)->where('customer_id',$customerId)->count();
        return $count >0?true:false;
    }

  
}
