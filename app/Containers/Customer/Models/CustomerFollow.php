<?php

namespace App\Containers\Customer\Models;

use App\Ship\Parents\Models\Model;

class CustomerFollow extends Model 
{

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'follow';


  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $guarded = [
  ];

  protected $casts = [];

  /**
   * The dates attributes.
   *
   * @var array
   */
  protected $dates = [];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = [];

  public function customer() {
    return $this->belongsTo(Customer::class, 'follower_id', 'id');
  }
} 
// End class
