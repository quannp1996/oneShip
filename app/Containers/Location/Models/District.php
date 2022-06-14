<?php

namespace App\Containers\Location\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class District extends Model
{
    protected $table = '_geovndistrict';

    protected $fillable = [
        'name',
        'code',
        'noithanh',
        'province_id',
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    // protected $dates = [
    //     'created_at',
    //     'updated_at',
    // ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = '_geovndistrict';

    public function city(){
        return $this->hasOne(City::class, 'code', 'province_id');
    }

    protected static function boot()
    {
        parent::boot();

        self::updating(function($model) {
            $model->noithanh = (int) $model->noithanh;
        });
    }
}
