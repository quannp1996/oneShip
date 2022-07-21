<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-09-22 00:58:06
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-22 11:58:41
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Traits;

use App\Containers\Location\Models\Ward;
use App\Containers\Location\Models\City;
use App\Containers\Location\Models\District;

trait OrderLocationTrait
{
    public function senderProvince()
    {
        return $this->hasOne(City::class, 'code', 'sender_province');
    }

    public function senderDistrict()
    {
        return $this->hasOne(District::class, 'code', 'sender_district');
    }

    public function senderWard()
    {
        return $this->hasOne(Ward::class, 'code', 'sender_ward');
    }

    public function receiverProvince()
    {
        return $this->hasOne(City::class, 'code', 'receiver_province');
    }

    public function receiverDistrict()
    {
        return $this->hasOne(District::class, 'code', 'receiver_district');
    }

    public function receiverWard()
    {
        return $this->hasOne(Ward::class, 'code', 'receiver_ward');
    }

    public function senderAddress()
    {   
        $location = [];
        if($this->relationLoaded('senderProvince')) $location[] = $this->senderProvince->name;
        if($this->relationLoaded('senderDistrict')) $location[] = $this->senderProvince->name;
        if($this->relationLoaded('senderWard')) $location[] = $this->senderProvince->name;
        return $this->sender_address1.' - '. implode(',', $location);
    }

    public function receiverAddress()
    {
        $location = [];
        if($this->relationLoaded('receiverProvince')) $location[] = $this->senderProvince->name;
        if($this->relationLoaded('receiverDistrict')) $location[] = $this->senderProvince->name;
        if($this->relationLoaded('receiverWard')) $location[] = $this->senderProvince->name;
        return $this->receiver_address1.' - '. implode(',', $location);
    }
}
