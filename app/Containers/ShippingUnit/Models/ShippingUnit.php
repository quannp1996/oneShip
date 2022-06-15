<?php

namespace App\Containers\ShippingUnit\Models;

use Apiato\Core\Foundation\ImageURL;
use App\Containers\ShippingUnit\Enums\EnumShipping;
use Jenssegers\Mongodb\Eloquent\Model;

class ShippingUnit extends Model
{
    protected $fillable = [
        'dev_mode', 'status', 'title', 'type', 'security', 'image'
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
            $model->status = (int) $model->status;
            $model->dev_mode = (int) $model->dev_mode;
        });
    }

    public function isDevMode(): bool
    {
        return (int) !!$this->dev_mode;
    }

    public function consts(){
        return $this->hasMany(ShippingConst::class, 'shippingUnitID', 'id');
    }

    public function services(){
        return $this->hasMany(ShippingServices::class, 'shippingID', 'id');
    }

    public function jsonConst()
    {
        if(!$this->relationLoaded('consts')) return '{}';
        return json_encode($this->consts->toArray());
    }
}
