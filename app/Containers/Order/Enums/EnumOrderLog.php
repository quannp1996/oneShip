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

final class EnumOrderLog
{
    const SHIPPING_SENT_KEY = 'order_sent';
    const SHIPPING_SENT_ERROR_KEY = 'order_error_sent';
    const SHIPPING_SENT = 'Đơn hàng đã được gửi sang đơn vị vận chuyển';
    const SHIPPING_ERROR_SENT= 'Đơn hàng gặp lỗi khi gửi sang đơn vị vận chuyển';
}
