<?php

/**
 * @ Created by: VSCode
 * @ Author: Oops!Memory - OopsMemory.com
 * @ Create Time: 2021-09-21 14:44:04
 * @ Modified by: Oops!Memory - OopsMemory.com
 * @ Modified time: 2021-09-21 15:25:46
 * @ Description: Happy Coding!
 */

namespace App\Containers\BaseContainer\Events\Handlers;

class BaseFrontEventHandler
{
    public $customer;

    public function __construct()
    {
        $this->customer = auth()->guard(config('auth.guard_for.frontend'))->user();
    }
}