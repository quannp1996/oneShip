<?php

namespace App\Containers\Field\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
        'lable', 'placeholder', 'sort_order', 'status', 'is_required'
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
    protected $resourceKey = 'fields';
}
