<?php

namespace App\Containers\Localization\Models;

use App\Containers\Localization\Traits\LanguageMethodTrait;
use Jenssegers\Mongodb\Eloquent\Model;

class Language extends Model
{
    use LanguageMethodTrait;

    protected $table = 'language';

    protected $primaryKey = 'language_id';
    protected $appends = ['id'];
    protected $fillable = [

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
    protected $resourceKey = 'languages';
}
