<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-28 21:21:19
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-28 21:41:31
 * @ Description: Happy Coding!
 */

namespace App\Containers\Location\UI\API\Controllers\FrontEnd;

use App\Containers\BaseContainer\UI\WEB\Controllers\BaseApiFrontController;
use App\Containers\Location\UI\API\Controllers\FrontEnd\Features\GetDistrict;
use App\Containers\Location\UI\API\Controllers\FrontEnd\Features\GetProvince;
use App\Containers\Location\UI\API\Controllers\FrontEnd\Features\GetWard;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;

class Controller extends BaseApiFrontController
{
    use GetDistrict, GetWard, GetProvince, ApiResTrait;

    public function __construct()
    {
        parent::__construct();
    }
}
