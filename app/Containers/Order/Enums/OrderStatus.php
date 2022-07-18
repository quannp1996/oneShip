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
     * Đã hủy đơn
     */
    const CANCEL = -1;
    
    /**
     * Đơn hàng mới 
     */
    const NEW_ORDER = 1;

    /**
     * Đơn hàng chuyển sang đơn vị vận chuyển
     */
    const ORDER_SENT = 3;

    /**
     * Bưu tá xác nhận đi lấy
     */
    const SHIPPING_CONFIRM_GET = 5;
    /**
     * Bưu tá đã lấy
     */
    const SHIPPING_GOT = 7;

    /**
     * Nhập kho
     */
    const IMPORT = 27;

    /**
     * Xuất kho đến
     */
    const EXPORT_TO = 37;

    /**
     * Đang vận chuyển
     */
    const ON_DELIVERY = 47;

    /**
     * Đang giao
     */
    const ON_DELIVERING = 57;

    /**
     * Giao hàng thành công
     */
    const DELIVERED = 67;

    /**
     * Giao hàng Không thành công
     */
    const NOT_DELIVERED = 77;

    /**
     * Chờ xử lí
     */
    const WAITING_PROCESS = 87;
    
    /**
     * Chuyển hoàn
     */
    const REFUND = 107;
    
    /**
     * Đã hoàn
     */
    const REFUNDED = 999;

    /**
     * @deprecated
     * 
     * Đã thanh toán
     */
    const PAID = 4;

    const TEXT = [
        self::NEW_ORDER => 'Khách Hàng tạo đơn',
        self::ORDER_SENT => 'Đơn Hàng sang đơn vị vận chuyển',
        self::SHIPPING_CONFIRM_GET => 'Bưu tá xác nhận đi lấy',
        self::SHIPPING_GOT => 'Bưu tá đã lấy',
        self::IMPORT => 'Nhập kho',
        self::EXPORT_TO => 'Xuất kho đến',
        self::ON_DELIVERY => 'Đang vận chuyển',
        self::ON_DELIVERING => 'Đang giao',
        self::DELIVERED => 'Giao hàng thành công',
        self::WAITING_PROCESS => 'Chờ xử lí',
        self::REFUND => 'Chuyển hoàn',
        self::REFUNDED => 'Đã hoàn',
        self::CANCEL => 'Đã hủy đơn'
    ];
}
