<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-24 13:39:24
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-19 21:33:02
 * @ Description: Happy Coding!
 */

namespace App\Containers\Customer\UI\API\Controllers\FrontEnd;

use App\Containers\BaseContainer\UI\WEB\Controllers\BaseApiFrontController;
use App\Containers\Customer\UI\API\Controllers\FrontEnd\Features\AddressBook\GetCustomerAddressBook;
use App\Containers\Customer\UI\API\Controllers\FrontEnd\Features\AddressBook\NewAddress;
use App\Containers\Customer\UI\API\Controllers\FrontEnd\Features\AddressBook\UpdateAddress;
use App\Containers\Customer\UI\API\Controllers\FrontEnd\Features\EditCustomerInfor;
use App\Containers\Customer\UI\API\Controllers\FrontEnd\Features\GetCustomerInfor;
use App\Containers\Customer\UI\API\Controllers\FrontEnd\Features\AddWishList;
use App\Containers\Customer\UI\API\Controllers\FrontEnd\Features\GetAllWishList;
use App\Containers\Customer\UI\API\Controllers\FrontEnd\Features\GetHistorySearch;
use App\Containers\Customer\UI\API\Controllers\FrontEnd\Features\SaveCustomerRef;

class Controller extends BaseApiFrontController
{
    use EditCustomerInfor,
        GetCustomerInfor,
        GetCustomerAddressBook,
        NewAddress,
        UpdateAddress,
        AddWishList,
        GetAllWishList,
        GetHistorySearch,
        SaveCustomerRef;
}
