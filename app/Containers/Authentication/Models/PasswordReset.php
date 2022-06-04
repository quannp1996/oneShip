<?php

namespace App\Containers\Authentication\Models;

use App\Ship\Parents\Models\Model;

class PasswordReset extends Model
{
    protected $table = 'password_resets';
    protected $fillable = [
        'email',
        'token',
        'source',
        'pass_reset'
    ];
}
// End class
