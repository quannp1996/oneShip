<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-08-13 13:18:03
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-08-28 23:33:30
 * @ Description: Happy Coding!
 */

namespace App\Ship\Parents\Requests;

class FrontEndRequest extends Request
{
    public $user;
    public function __construct()
    {
        $this->user = auth()->guard(config('auth.guard_for.frontend'))->user();
    }
}
