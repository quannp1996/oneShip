<?php

namespace App\Ship\Parents\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController as AbstractApiController;
use App\Ship\core\Traits\HelpersTraits\ApiResTrait;

abstract class ApiController extends AbstractApiController
{
    use ApiResTrait;
}
