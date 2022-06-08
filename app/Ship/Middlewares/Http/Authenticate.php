<?php

namespace App\Ship\Middlewares\Http;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as LaravelAuthenticate;

/**
 * Class Authenticate
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Authenticate extends LaravelAuthenticate
{
    public function authenticate($request, array $guards)
    {
        try {
            return parent::authenticate($request, $guards);
        }
        catch (Exception $exception) {
            throw new AuthenticationException();
        }
    }
}
