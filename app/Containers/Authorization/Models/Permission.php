<?php

namespace App\Containers\Authorization\Models;

use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use Maklad\Permission\Models\Permission as SpatiePermission;

/**
 * Class Permission
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Permission extends SpatiePermission
{

    use HashIdTrait;
    use HasResourceKeyTrait;
    protected $guard_name = 'admin';
    protected $appends = ['id'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'guard_name',
        'display_name',
        'description',
        'containers'
    ];
}
