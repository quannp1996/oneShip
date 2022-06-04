<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-21 12:34:39
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-11-16 16:30:23
 * @ Description: Happy Coding!
 */

namespace App\Containers\Order\UI\API\Controllers\FrontEnd;

use App\Containers\BaseContainer\UI\WEB\Controllers\BaseApiFrontController;
use App\Containers\Order\UI\API\Controllers\FrontEnd\Features\BuyOrderAgain;
use App\Containers\Order\UI\API\Controllers\FrontEnd\Features\CheckoutOnlineHandler;
use App\Containers\Order\UI\API\Controllers\FrontEnd\Features\OrderDetail;
use App\Containers\Order\UI\API\Controllers\FrontEnd\Features\OrderList;
use App\Containers\Order\UI\API\Controllers\FrontEnd\Features\SaveOrder;
use App\Containers\Order\UI\API\Controllers\FrontEnd\Features\CancelOrder;

class Controller extends BaseApiFrontController
{
    use SaveOrder,
        CheckoutOnlineHandler,
        OrderList,
        OrderDetail,
        CancelOrder,
        BuyOrderAgain;

    public function __construct()
    {
        parent::__construct();
    }
}
