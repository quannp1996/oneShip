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

use App\Containers\BaseContainer\Enums\BaseEnum;

final class OrderStatus extends BaseEnum
{
    /**
     * Đơn hủy
     */
    const CANCEL = -1;
    
    /**
     * Đơn hàng mới
     */
    const NEW_ORDER = 1;

      /**
     * Đơn hàng mới
     */
    const UNPAID = 2;
    /**
     * Đã tiếp nhận
     */
    const ASSIGNED = 7;

     /**
     * Xuất hàng khỏi kho
     */
    const EXPORTED = 27;

    /**
     * Đang giao hàng
     */
    const ON_DELIVERY = 47;

    /**
     * Đã giao hàng
     */
    const DELIVERED = 67;

    /**
     * Đơn chờ hoàn tiền
     */
    const PENDING_REFUND = 87;
    
    /**
     * Đơn hoàn tiền
     */
    const REFUND = 107;
    
    /**
     * Đơn hoàn thành
     */
    const DONE = 999;

    /**
     * @deprecated
     * 
     * Đã thanh toán
     */
    const PAID = 4;

    const TEXT = [
        self::NEW_ORDER => 'Đơn hàng mới',
        self::ASSIGNED => 'Đã tiếp nhận',
        self::UNPAID => 'Chưa thanh toán',
        self::EXPORTED => 'Xuất khỏi kho',
        self::ON_DELIVERY => 'Đang giao hàng',
        self::DELIVERED => 'Đã giao hàng',
        self::REFUND => 'Đã hoàn tiền',
        self::DONE => 'Đơn hoàn thành',
        self::CANCEL => 'Đơn hủy',
    ];
}
