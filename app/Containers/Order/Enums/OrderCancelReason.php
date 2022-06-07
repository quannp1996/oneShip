<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-04 22:37:51
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-30 15:26:50
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\Enums;

use App\Containers\BaseContainer\Enums\BaseEnum;

final class OrderCancelReason extends BaseEnum
{
    /**
     * Đơn hàng trùng lặp
     */
    const DUPLICATED = 1;

    /**
     * Thời gian giao hàng quá lâu
     */
    const TOO_SLOW = 20;

    /**
     * Mua thêm sản phẩm khác
     */
    const BUY_MORE = 40;

    /**
     * Thay đổi địa chỉ giao hàng
     */
    const CHANGE_ADDRESS = 60;

    /**
     * Lý do khác
     */
    const OTHER = 999;

    const TEXT = [
        self::DUPLICATED => 'Đơn hàng trùng lặp',
        self::TOO_SLOW => 'Thời gian giao quá lâu',
        self::BUY_MORE => 'Mua thêm sản phẩm khác',
        self::CHANGE_ADDRESS => 'Thay đổi địa chỉ giao hàng',
        self::OTHER => 'Lý do khác',
    ];
}
