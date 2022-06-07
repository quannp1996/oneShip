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

use App\Containers\Location\Models\City;
use App\Containers\Location\Models\District;
use App\Containers\Location\Models\Ward;

trait OrderLocationTrait
{
    public function province()
    {
        return $this->hasOne(City::class, 'id', 'province_id');
    }

    public function district()
    {
        return $this->hasOne(District::class, 'id', 'district_id');
    }

    public function ward()
    {
        return $this->hasOne(Ward::class, 'id', 'ward_id');
    }

    public function stringAddress()
    {
        $string = !empty($this->ward) ? ', ' . $this->ward->name : '';
        $string .= !empty($this->district) ? ', ' . $this->district->name : '';
        $string .= !empty($this->province) ? ', ' . $this->province->name : '';
        return $this->address . $string;
    }
}
