<?php

namespace App\Containers\ShippingUnit\Models;

use Apiato\Core\Foundation\ImageURL;
use App\Containers\ShippingUnit\Enums\EnumShipping;
use Jenssegers\Mongodb\Eloquent\Model;

class ShippingConst extends Model
{

    protected $tables = 'shippingconst';
    protected $appends = ['id'];
    protected $fillable = [
        'title', 'items', 'shippingUnitID', 'is_default'
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
    protected $resourceKey = 'shippingunits';

    public function getResourceKey()
    {
        return $this->resourceKey;
    }
    public function toSecurityJson()
    {
        return json_decode($this->security, true);
    }

    public function getTypeName()
    {
        return EnumShipping::LISTTYPE[$this->type];
    }

    public function getImageUrl()
    {
        if($this->image) return ImageURL::getImageUrl($this->image, 'shipping', '');
        return null;
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function($model) {
            $model->is_default = (int) $model->is_default;
        });
    }

    public function isDevMode(): bool
    {
        return (int) !!$this->dev_mode;
    }

    public function getItems()
    {
        try{
            return json_decode($this->items, true);
        }catch(\Exception $e){
            return [];
        }
    }
}
