<?php

namespace App\Containers\Contact\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'shop_name', 'email', 'phone'
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

    public function getResourceKey(){
        return $this->resourceKey;
    }

    public function fields(){
        return $this->hasMany(ContactField::class, 'contact_id', 'id');
    }

    public function valueById($id){
        if ($this->fields->filter(function($item) use($id) {
            return $item->field_id == $id;
        })->isNotEmpty()) {
            return $this->fields->filter(function($item) use($id) {
                return $item->field_id == $id;
            })->first()->value;
        }
        return null;
    }
}
