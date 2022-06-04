<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-04 22:27:48
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-04 22:35:13
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class CannotInitClassException extends Exception
{

    public $httpStatusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Cannot Init Class!';
}
