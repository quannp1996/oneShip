<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2020-10-04 13:58:15
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 17:21:27
 * @ Description:
 */

namespace App\Containers\Settings\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class DeliveryType extends Model
{
    protected $table = 'delivery_type';

    protected $fillable = [
        'status',
        'sort_order',
        'shipping_fee',
        'min_order_free_ship'
    ];

    public function desc()
    {
        return $this->hasOne(DeliveryTypeDesc::class, 'delivery_type_id', 'id');
    }

    public function all_desc()
    {
        return $this->hasManyKeyBy('language_id', DeliveryTypeDesc::class, 'delivery_type_id', 'id');
    }
}
