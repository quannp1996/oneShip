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
    public function sender_province()
    {
        return $this->hasOne(City::class, 'code', 'sender_province');
    }

    public function sender_district()
    {
        return $this->hasOne(District::class, 'code', 'sender_district');
    }

    public function sender_ward()
    {
        return $this->hasOne(Ward::class, 'code', 'sender_ward');
    }

    public function receiver_province()
    {
        return $this->hasOne(City::class, 'code', 'receiver_province');
    }

    public function receiver_district()
    {
        return $this->hasOne(District::class, 'code', 'receiver_district');
    }

    public function receiver_ward()
    {
        return $this->hasOne(Ward::class, 'code', 'receiver_ward');
    }

    public function senderAddress()
    {

    }

    public function receiverAddress()
    {
        
    }
}
