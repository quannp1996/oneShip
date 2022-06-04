<?php

namespace App\Ship\Middlewares\Http;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class RedirectIfAuthenticated
 *
 * A.K.A app/Http/Middleware/RedirectIfAuthenticated.php
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class RedirectIfAuthenticated
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == 'admin' && Auth::guard($guard)->check()) {
            return redirect()->to(route('get_admin_dashboard_page'));
        }
        
        if($guard == 'customer' && Auth::guard($guard)->check()) {
            return redirect()->to(route('web.home.index'));
        }

        return $next($request);
    }

}
