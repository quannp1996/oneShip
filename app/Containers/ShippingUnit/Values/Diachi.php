<?php

namespace App\Containers\ShippingUnit\Values;

use App\Ship\Parents\Values\Value;

class Diachi extends Value
{
    public $province;

    public $district;

    public $ward;

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'diachi';

    public function __construct(array $diachi = [])
    {
        $this->province = @$diachi['province'];
        $this->district = @$diachi['district'];
        $this->ward = @$diachi['ward'];
    }
}   
