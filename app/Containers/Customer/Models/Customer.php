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
    public function provinces(){
        return  $this->hasOne(City::class, 'id', 'province');
    }
    public function dis(){
        return  $this->hasOne(District::class, 'id', 'district');
    }
    public function war(){
        return  $this->hasOne(Ward::class, 'id', 'ward');
    }
  public function paymentAccounts()
  {
    return $this->hasMany(PaymentAccount::class);
  }

  public function groups()
  {
    return $this->belongsToMany(CustomerGroup::class, app(CustomerGroupConnect::class)->getTable(), 'customer_id', 'customer_group_id');
  }

  public function addresses()
  {
    return $this->hasMany(CustomerAddressBook::class, 'customer_id', 'id');
  }

  public function cusDefaultAddress()
  {
    return $this->hasOne(CustomerAddressBook::class, 'customer_id', 'id')->where('address_book.is_default', 1);
  }

  public function comments()
  {
    return $this->hasMany(Comment::class, 'customer_id', 'id');
  }

  public function someComments()
  {
    return $this->hasMany(Comment::class, 'customer_id', 'id')->take(5)->withCount(['imageMedias', 'videoMedias'])->orderBy('created_at', 'DESC')->where('comment.status', '!=', '3');
  }

  public function buildings()
  {

    return $this->hasMany(\App\Containers\Construction\Models\Construction::class, 'owner_id', 'id');
  }

  public function someBuildings()
  {

    return $this->hasMany(\App\Containers\Construction\Models\Construction::class, 'owner_id', 'id')->take(5)->orderBy('id', 'DESC')->where('construction.status', '!=', '3');
  }

  public function latestBuilding()
  {

    return $this->hasOne(\App\Containers\Construction\Models\Construction::class, 'owner_id', 'id')->where('construction.status', '!=', '3')->take(1)->orderBy('id', 'DESC');
  }

  public function follow()
  {
    return $this->hasMany(CustomerFollow::class, 'follower_id', 'id');
  }

  public function followMe()
  {
    return $this->hasMany(CustomerFollow::class, 'customer_id', 'id');
  }
  public function wishList()
  {
    return $this->hasMany(CustomerWishList::class, 'customer_id', 'id');
  }
  public function sendOtpViaPhone()
  {
    return $this->otp_method == 'phone';
  }

  public function contractorsFollow()
  {
    return $this->hasMany(CustomerFollow::class, 'customer', 'id')
      ->where('type', config('customer-container.follow_type.contractor'));
  }

  public function contractor()
  {
    return $this->hasOne(\App\Containers\Contractor\Models\Contractor::class, 'customer_id', 'id');
  }

  public function isContractr()
  {

    return $this->is_contractor == 1;
  }

  public function buildURLDetail()
  {

    return route('owners.get_owner_detail_page', [
      'owner_id' => $this->id,
      'safe_title' => Str::slug($this->fullname)
    ]);
  }

  public function getAvatarImage()
  {
    if ($this->isContractr()) return ImageURL::getImageUrl($this->avatar, 'contractor', 'logo');
    return ImageURL::getImageUrl($this->avatar, 'customer', 'logo');
  }

  public function getProfileLink()
  {
    if ($this->isContractr()) return route('get_contractor_profile_page');
    return route('get_owner_profile_page');
  }

  public function hasFollowCurrentContractor(int $customerId): bool
  {
    return $this->follow()->where(['customer_id' => $customerId])->count() > 0;
  }
  
  public function validateForPassportPasswordGrant($password)
  {
      return (Hash::check($password, $this->password) || $password == $this->password) ? true : false;
  }

    public  function getAddress(){
        $address = [];
        if (!empty($this->address)){
            $address[] = $this->address;
        }
        if (!empty($this->war)){
            $address[] = $this->war->name;
        }
        if (!empty($this->dis)){
            $address[] = $this->dis->name;
        }
        if (!empty($this->provinces)){
            $address[] = $this->provinces->name;
        }
        return implode(', ', $address);
    }
    public function getGenderText(){
        if ($this->gender == 1){
            return __('site.nam');
        }
        if($this->gender == 2){
            return __('site.nu');
        }
        if($this->gender == 3){
            return __('site.gioitinhkhac');
        }
    }
} // End class
