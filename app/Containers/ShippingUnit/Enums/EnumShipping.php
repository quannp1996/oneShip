<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-04 22:37:51
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-30 15:26:50
 * @ Description: Happy Coding!
 */

namespace App\Containers\ShippingUnit\Enums;

use App\Containers\BaseContainer\Enums\BaseEnum;

final class EnumShipping extends BaseEnum
{
    const GHTK = 'ghtk';
    const NINJAVAN = 'ninjavan';
    const FILLFIELD = [
        'dev_mode', 'status', 'title', 'type', 'security', 'image', 'vung', 'time'
    ];
    const LISTTYPE = [
        self::GHTK => 'Giao hàng tiết kiệm',
        self::NINJAVAN => 'NinjaVan'
    ];
}
