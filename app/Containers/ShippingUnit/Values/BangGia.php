<?php

namespace App\Containers\ShippingUnit\Values;

use App\Ship\Parents\Values\Value;

class BangGia extends Value
{
    public $follow;

    public $total_follow;

    public $status;

    public $message;

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'banggia';

    public function __construct()
    {
        
    }
}   
