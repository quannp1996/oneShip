<?php

namespace App\Containers\ShippingUnit\Values;

use App\Containers\ShippingUnit\Enums\EnumPickUpMethod;
use App\Ship\Parents\Values\Value;

class DonHang extends Value
{
    const CONSTREGION = 'vungmien';
    const CONSTPROVINCE = 'tinh';
    const CONSTDISTRICT = 'thanh';

    public string $in = 'in';
    public int $weight;
    public array $services;
    public Diachi $sender;
    public Diachi $receiver;
    public string $pich_up_method;
    public string $condition = self::CONSTPROVINCE;

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'donhang';

    public function __construct(array $package = [])
    {
        $this->weight = (int) $package['package']['weight'];
        $this->pich_up_method   = !empty($package['pick_up_method']) && in_array($package['pick_up_method'], EnumPickUpMethod::LIST) 
                                    ? $package['pick_up_method'] 
                                    : EnumPickUpMethod::MANGRA;
        $this->sender           = new Diachi($package['sender']);
        $this->receiver         = new Diachi($package['receiver']);
        $this->services         = @$package['services'] ?? [];
    }

    public function sameProvince(): bool
    {
        return $this->sender->province->code == $this->receiver->province->code;
    }

    public function sameDistrict(): bool
    {
        return $this->sender->district == $this->receiver->district;
    }

    public function sameWard(): bool
    {
        return $this->sender->ward == $this->receiver->ward;
    }

    public function sameRegion(): bool
    {
        return $this->sender->province->vung;
    }

    public function getCondition(): void
    {
        if($this->sameProvince()){
            $this->condition = 'thanh';
            if($this->sameDistrict()){
                $this->in = $this->sender->district->noithanh && $this->receiver->district->noithanh ? 'in' : 'out';
            }else{

            }
        }else{
            $this->condition = self::CONSTREGION;
            $this->in = $this->sender->province->vung === $this->sender->province->vung ? 'in' : 'out';
        }
    }

    public function getServicesNotActive(): array
    {
        return array_merge($this->sender->province->disabled ?? [], $this->receiver->province->disabled ?? []);
    }
}   
