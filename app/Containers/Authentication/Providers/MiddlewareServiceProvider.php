<?php

namespace App\Containers\Authentication\Providers;

use App\Containers\Authentication\Middlewares\RedirectIfAuthenticated;
use App\Containers\Authentication\Middlewares\WebAuthentication;
use App\Ship\Parents\Providers\MiddlewareProvider;

/**
 * Class MiddlewareServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class MiddlewareServiceProvider extends MiddlewareProvider
{

    /**
     * Register Middleware's
     *
     * @var  array
     */
    protected $middlewares = [
        // ..
    ];

    /**
     * Register Container Middleware Groups
     *
     * @var  array
     */
    protected $middlewareGroups = [
        'admin' => [
            // ..
        ],
        'web' => [
            // ..
        ],
        'api' => [
            // ..
        ],
    ];

    protected $routeMiddleware = [
        'auth:web' => WebAuthentication::class,
        'auth:admin' => RedirectIfAuthenticated::class,
    ];
}
