<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2022-02-18 14:44:32
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2022-02-18 14:53:20
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Enums;

use App\Containers\BaseContainer\Enums\BaseEnum;

final class CustomerStatus extends BaseEnum
{
    /**
     * Khóa
     */
    const BLOCKED = 3;

    const TEXT = [
        self::ACTIVE => 'Đã kích hoạt',
        self::DE_ACTIVE => 'Chưa kích hoạt',
        self::DELETE => 'Đã xóa',
        self::BLOCKED => 'Đã khóa',
    ];

    const CLASS_CSS = [
        self::ACTIVE => 'success',
        self::DE_ACTIVE => 'secondary',
        self::DELETE => 'danger',
        self::BLOCKED => 'warning',
    ];
}
