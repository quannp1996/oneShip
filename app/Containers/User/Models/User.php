<?php

namespace App\Containers\User\Models;

use Apiato\Core\Foundation\ImageURL;
use App\Containers\Authorization\Traits\AuthenticationTrait;
use App\Containers\Authorization\Traits\AuthorizationTrait;
use App\Containers\User\Traits\UserRankTrait;
use App\Containers\User\Traits\UserStatusTrait;
use App\Ship\Parents\Models\UserModel;
use Illuminate\Notifications\Notifiable;

/**
 * Class User.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class User extends UserModel 
{

    use AuthorizationTrait;
    use AuthenticationTrait;
    use Notifiable;
    use UserStatusTrait;
    use UserRankTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $guard_name = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'avatar',
        'email',
        'phone',
        'password',
        'gender',
        'birth',
        'last_login',
        'last_login_ip',
        'last_logout',
        'last_active',
        'status',
        'active'
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
        'last_login',
        'last_logout',
        'last_active',
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

    public function getImageUrl($size = 'original'){
        return ImageURL::getImageUrl($this->avatar, 'avatar', $size);
    }
 
} // End class
