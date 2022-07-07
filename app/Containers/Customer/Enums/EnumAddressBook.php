<?php

/**
 * @ Created by: VSCode
 * @ Author: QuanNP - npquan1995@gmai.com
 * @ Create Time: 2021-08-04 22:37:51
 * @ Modified by: QuanNP - npquan1995@gmai.com
 * @ Modified time: 2021-09-19 21:31:55
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\Enums;

use App\Containers\BaseContainer\Enums\BaseEnum;

final class EnumAddressBook extends BaseEnum
{
    const CAN_FILL = ['fullname', 'phone', 'email', 'province_id', 'district_id', 'ward_id', 'village', 'zipcode', 'address1', 'address2', 'type', 'is_default', 'customerID'];
}
