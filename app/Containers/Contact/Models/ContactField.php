<?php

namespace App\Containers\Contact\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class ContactField extends Model
{
    protected $table = 'contacts_field';

    protected $fillable = [
        'contact_id', 'field_id', 'value'
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
    protected $resourceKey = 'contacts';
}
