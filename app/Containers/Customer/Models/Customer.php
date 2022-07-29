<?php

namespace App\Containers\Customer\Models;

use App\Containers\Location\Models\City;
use App\Containers\Location\Models\District;
use App\Containers\Location\Models\Ward;
use Illuminate\Support\Str;
use App\Ship\Parents\Models\UserModel;
use Illuminate\Notifications\Notifiable;
use App\Containers\Comment\Models\Comment;
use Apiato\Core\Foundation\Facades\ImageURL;
use Apiato\Core\Traits\JWTTrait;
use App\Containers\Authorization\Traits\AuthorizationTrait;
use App\Containers\Authorization\Traits\AuthenticationTrait;
use App\Containers\Order\Models\Order;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customer extends UserModel implements JWTSubject
{
  use JWTTrait;
  use AuthorizationTrait;
  use AuthenticationTrait;
  use Notifiable;
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'customer';

  protected $guard_name = 'customers';

  protected $appends = ['id'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'fullname',
    'email',
    'user_name',
    'phone',
    'password',
    'password_encode',
    'device',
    'avatar',
    'address',
    'platform',
    'otp_method',
    'gender',
    'birth',
    'status',
    'is_contractor',
    'date_of_birth',
    'social_provider',
    'social_token',
    'social_refresh_token',
    'social_expires_in',
    'social_token_secret',
    'social_id',
    'social_avatar',
    'social_avatar_original',
    'social_nickname',
    'confirmed',
    'is_client',
    'is_active',
    'province',
    'district',
    'ward',
  ];

  protected $casts = [
    'is_client' => 'boolean',
    'confirmed' => 'boolean',
  ];

  /**
   * The dates attributes.
   *
   * @var array
   */
  protected $dates = [
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function groups()
  {
    return $this->belongsToMany(CustomerGroup::class, app(CustomerGroupConnect::class)->getTable(), 'customer_id', 'customer_group_id');
  }

  public function addresses()
  {
    return $this->hasMany(CustomerAddressBook::class, 'customer_id', 'id');
  }

  public function getAvatarImage()
  {
    if ($this->isContractr()) return ImageURL::getImageUrl($this->avatar, 'contractor', 'logo');
    return ImageURL::getImageUrl($this->avatar, 'customer', 'logo');
  }

  public function orders(): HasMany
  {
    return $this->hasMany(Order::class, 'customerID', 'id');
  }
} // End class
