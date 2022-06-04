<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-04 22:37:51
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-26 22:26:59
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\Enums;

use App\Containers\BaseContainer\Enums\BaseEnum;

final class PaymentStatus extends BaseEnum
{
    /**
     * Đã thanh toán
     */
    const PAID = 1;
    /**
     * Chưa Thanh toán
     */
    const NON_PAID = 2;

    const TEXT = [
        self::PAID => 'Đã thanh toán',
        self::NON_PAID => 'Chưa thanh toán',
    ];
}
