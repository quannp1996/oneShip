<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-04 22:37:51
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-10-26 17:28:48
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Enums;

final class EnumShipPicking
{
    const GUI_HANG = 1;
    const LAY_HANG = 2;
    const LIST = [
        self::GUI_HANG => 'Gửi hàng tại bưu cục',
        self::LAY_HANG => 'Lấy hàng'
    ];
}
