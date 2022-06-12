<?php

namespace App\Containers\ShippingUnit\Values;

use App\Containers\ShippingUnit\Enums\EnumPickUpMethod;
use App\Ship\Parents\Values\Value;

class DonHang extends Value
{
    const SAMEPROVINCE = 'vungmien';
    const SAMEDISTRICT = 'tinh';
    const SAMEWARD = 'thanh';

    public $weight;
    public $pich_up_method;
    public Diachi $sender;
    public Diachi $receiver;

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'donhang';

    public function __construct(array $package = [])
    {
        $this->weight = (int) $package['package']['weight'];
        $this->pich_up_method = @$package['pick_up_method'] && in_array($package['pick_up_method'], EnumPickUpMethod::LIST) 
                                ? $package['pick_up_method'] 
                                : EnumPickUpMethod::MANGRA;
        $this->sender = new Diachi($package['sender']);
        $this->receiver = new Diachi($package['receiver']);
    }

    public function sameProvince(): bool
    {
        return $this->sender->province == $this->receiver->province;
    }

    public function sameDistrict(): bool
    {
        return $this->sender->district == $this->receiver->district;
    }

    public function sameWard(): bool
    {
        return $this->sender->ward == $this->receiver->ward;
    }

    public function getCondition(): string
    {
        if($this->sameWard()) return self::SAMEWARD;
        if($this->sameDistrict()) return self::SAMEDISTRICT;
        if($this->sameProvince()) return self::SAMEPROVINCE;
        return self::SAMEPROVINCE;
    }

    public function isIn()
    {
        return 'in';
    }
}   
