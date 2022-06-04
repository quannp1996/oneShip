<?php

namespace App\Containers\Localization\Middlewares;

use Apiato\Core\Foundation\Facades\Apiato;
use Apiato\Core\Foundation\Facades\FunctionLib;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Cookie;

class WebLocalizationMiddleware extends LocalizationMiddleware
{

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return  mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // find and validate the lang on that request
        //$lang = $this->validateLanguage($this->findLanguage($request));
        $lang = Apiato::call('Localization@CheckSegmentLanguageAction');

        // dump($lang);
        if($lang) {
            Cookie::queue(FunctionLib::getLanguageKey(), $lang, 60 * 24 * 365);

            app()->setLocale($lang);
        }

        return $next($request);
    }
}
