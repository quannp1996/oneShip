<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-10-10 16:16:15
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-10 16:21:39
 * @ Description: Happy Coding!
 */

namespace App\Containers\Banner\Enums;

use App\Containers\BaseContainer\Enums\BaseEnum;

final class BannerType extends BaseEnum
{
    const MOBILE = 1;
    const DESKTOP = 0;

    const TEXT = [
        self::MOBILE => 'Mobile',
        self::DESKTOP => 'Desktop (Tablet)'
    ];
}
