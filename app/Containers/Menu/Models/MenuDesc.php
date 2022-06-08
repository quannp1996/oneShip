<?php

namespace App\Containers\Menu\Models;

use App\Containers\Localization\Models\Language;
use Jenssegers\Mongodb\Eloquent\Model;

class MenuDesc extends Model
{
    protected $table = 'menu_description';

    protected $guarded = [

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
    protected $resourceKey = 'menudescs';


    public function language() {
      return $this->hasOne(Language::class, 'language_id', 'language_id');
    }
}
