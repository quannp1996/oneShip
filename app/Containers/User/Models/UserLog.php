<?php

namespace App\Containers\User\Models;

use App\Ship\Parents\Models\Model;

class UserLog extends Model
{
    protected $table = 'user_log';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'object_id',
        'user_id',
        'after',
        'before',
        'ip',
        'env',
        'device',
        'model',
        'action',
        'action',
        'url',
        'note'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
