<?php

namespace App\Containers\Order\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use App\Containers\User\Models\User;
use App\Containers\Order\Traits\PriceTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Containers\Settings\Models\PaymentType;
use App\Containers\Order\Traits\OrderScopeTrait;
use App\Containers\Settings\Enums\PaymentStatus;
use App\Containers\Settings\Models\DeliveryType;
use App\Containers\Order\Traits\OrderStatusTrait;
use App\Containers\Order\Traits\OrderPaymentTrait;
use App\Containers\Order\Traits\OrderCustomerTrait;
use App\Containers\Order\Traits\OrderDeliveryTrait;
use App\Containers\Order\Traits\OrderLocationTrait;
use App\Containers\Customer\Models\CustomerRefRevenue;
use App\Containers\ShippingUnit\Models\ShippingUnit;

class Order extends Model
{
  use SoftDeletes,
    PriceTrait,
    OrderPaymentTrait,
    OrderDeliveryTrait,
    OrderStatusTrait,
    OrderScopeTrait,
    OrderLocationTrait,
    OrderCustomerTrait;

  protected $table = 'orders';

  protected $guarded = [];

  protected $attributes = [];

  protected $hidden = [];

  protected $casts = [];

  protected $dates = [
    'created_at',
    'updated_at',
    'deleted_at'
  ];

  /**
   * A resource key to be used by the the JSON API Serializer responses.
   */
  protected $resourceKey = 'orders';

  public function getResourceKey()
  {
    return $this->resourceKey;
  }

  public function orderItems()
  {
    return $this->hasMany(OrderItem::class, 'order_id', 'id');
  }

  public function paymentType()
  {
    return $this->hasOne(PaymentType::class, 'id', 'payment_type');
  }

  public function deliveryType()
  {
    return $this->hasOne(DeliveryType::class, 'id', 'delivery_type');
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function logs()
  {
    return $this->hasMany(OrderLog::class, 'order_id', 'id');
  }

  public function notes()
  {
    return $this->hasMany(OrderNote::class, 'order_id', 'id');
  }

  public function getTotalPrice()
  {
    $total = 0;
    foreach ($this->orderItems as $item) {
      $total += $item->price * $item->quantity;
    }
    return $total;
  }

  public function isPaid(): bool
  {
    return $this->payment_status == PaymentStatus::PAID;
  }

  public function shipping()
  {
      return $this->hasOne(ShippingUnit::class, '_id', 'shippingUnitID');
  }
} // End class
