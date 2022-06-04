<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2020-11-20 16:38:30
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-10-29 11:44:42
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\Middlewares;

use App\Containers\Settings\Actions\GetAllSettingsAction;
use Closure;
use Illuminate\Http\Request;

class Maintenance
{
    protected $settings = [];

    public function handle(Request $request, Closure $next)
    {
        $this->settings = app(GetAllSettingsAction::class)->run('Array', true);

        if (isset($this->settings['website']['down_for_constructions']) && $this->settings['website']['down_for_constructions']) {
            return redirect()->to(route('maintenance'));
        }

        return $next($request);
    }
}
