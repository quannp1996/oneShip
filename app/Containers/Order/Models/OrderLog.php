<?php

namespace App\Containers\Order\Models;

use App\Containers\Customer\Models\Customer;
use App\Containers\User\Models\User;
use App\Ship\Parents\Models\Model;

class OrderLog extends Model
{
  protected $table = 'order_logs';
  protected $guarded = [];

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
  protected $resourceKey = 'orderlogs';

  public function isUserProcess(): bool
  {
    return $this->object_model == User::class;
  }

  public function isCustomerProcess(): bool
  {
    return $this->object_model == Customer::class;
  }

  public function getObjectProcessText(): string
  {
    if ($this->isUserProcess()) {
      return 'Nhân sự';
    } elseif ($this->isCustomerProcess()) {
      return 'Khách hàng';
    }
    return 'Không xác định';
  }

} // End class
