<?php

namespace App\Containers\Authentication\Middlewares;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated extends Middleware
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;


    /**
     * WebAuthentication constructor.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->auth->guest()) {
            return redirect(Apiato::getLoginWebPageName())
                ->with('errorMessage', 'Credentials Incorrect.');
        }

        if ($this->auth->check()) {
            if(!empty($guard)){
                return redirect('/home');
            }
            return redirect('admin/home');
        }

        return $next($request);
    }
}
