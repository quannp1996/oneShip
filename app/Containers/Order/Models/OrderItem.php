<?php

namespace App\Containers\Order\Models;

use App\Containers\Order\Traits\OrderItemTrait;
use App\Containers\Product\Models\Product;
use App\Containers\Product\Models\ProductVariant;
use App\Ship\Parents\Models\Model;

class OrderItem extends Model
{
    use OrderItemTrait;

    protected $table = 'order_items';

    protected $appends = [
      'price_currency',
      'total_price_product_currency'
    ];

    protected $fillable = [

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
    protected $resourceKey = 'orderitems';

    public function product() {
      return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function productVariant() {
      return $this->belongsTo(ProductVariant::class, 'variant_id', 'product_variant_id');
    }

    public function productGiftVariant() {
      return $this->belongsTo(ProductVariant::class, 'variant_parent_id', 'product_variant_id');
    }
} // End class
