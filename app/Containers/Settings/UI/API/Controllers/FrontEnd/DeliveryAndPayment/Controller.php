<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-19 23:39:15
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-20 02:43:20
 * @ Description: Happy Coding!
 */

namespace App\Containers\Settings\UI\API\Controllers\FrontEnd\DeliveryAndPayment;

use App\Containers\BaseContainer\UI\WEB\Controllers\BaseApiFrontController;
use App\Containers\Settings\UI\API\Controllers\FrontEnd\DeliveryAndPayment\Features\GetPayAndDeliMethods;

class Controller extends BaseApiFrontController
{
    use GetPayAndDeliMethods;

    public function __construct()
    {
        parent::__construct();
    }
}
