<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2020-10-04 13:58:15
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 01:36:53
 * @ Description:
 */

namespace App\Containers\Settings\Models;

use App\Ship\Parents\Models\Model;

class PaymentType extends Model
{
    protected $table = 'payment_type';

    protected $fillable = [
        'online_method',
        'status',
        'sort_order',
    ];

    public function desc()
    {
        return $this->hasOne(PaymentTypeDesc::class, 'payment_type_id', 'id');
    }

    public function all_desc()
    {
        return $this->hasManyKeyBy('language_id', PaymentTypeDesc::class, 'payment_type_id', 'id');
    }
}
